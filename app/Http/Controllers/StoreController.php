<?php
// File: app/Http/Controllers/StoreController.php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan view form pembuatan toko
        return view('store.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:'.Store::class],
            'description' => ['nullable', 'string'],
        ]);

        // Buat toko baru dan hubungkan dengan user yang sedang login
        Auth::user()->store()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Arahkan ke dashboard setelah berhasil membuat toko
        return redirect()->route('dashboard')->with('status', 'Toko berhasil dibuat!');
    }
}
