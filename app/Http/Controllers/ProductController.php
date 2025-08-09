<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $store = Auth::user()->store;
        if (!$store) {
            return redirect()->route('store.create')->with('status', 'Anda harus membuat toko terlebih dahulu!');
        }
        $products = $store->products()->latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $store = Auth::user()->store;
        $product = $store->products()->create($request->only(['name', 'description', 'price', 'stock']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('products.index')->with('status', 'Produk berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Otorisasi: Pastikan produk ini milik toko user yang sedang login
        if ($product->store_id !== Auth::user()->store->id) {
            abort(403); // Tampilkan halaman Forbidden
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Otorisasi
        if ($product->store_id !== Auth::user()->store->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($request->only(['name', 'description', 'price', 'stock']));

        return redirect()->route('products.index')->with('status', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Otorisasi
        if ($product->store_id !== Auth::user()->store->id) {
            abort(403);
        }

        // Hapus gambar dari storage
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        // Hapus produk (dan relasi gambar akan terhapus otomatis karena onDelete('cascade'))
        $product->delete();

        return redirect()->route('products.index')->with('status', 'Produk berhasil dihapus!');
    }
}
