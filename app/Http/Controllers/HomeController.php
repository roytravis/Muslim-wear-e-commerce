<?php
// File: app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan semua produk.
     */
    public function index()
    {
        // Ambil semua produk, urutkan dari yang terbaru
        // Eager load relasi 'images' untuk efisiensi query
        $products = Product::with('images')->latest()->get();

        return view('home', compact('products'));
    }

    /**
     * Menampilkan halaman detail satu produk.
     */
    public function show(Product $product)
    {
        // Eager load relasi 'images' untuk produk yang spesifik ini
        $product->load('images');

        // Tampilkan view detail produk dan kirim data produknya
        return view('product.show', compact('product'));
    }
}
