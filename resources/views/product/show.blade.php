{{-- File: resources/views/product/show.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Judul halaman akan dinamis sesuai nama produk --}}
        <title>{{ $product->name }} - Marketplace Baju</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
        {{-- Import Swiper.js untuk Carousel --}}
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <!-- Scripts Laravel Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* Style kustom untuk Swiper.js */
            .swiper-button-next, .swiper-button-prev {
                color: #1F2937; /* Warna panah */
            }
            .swiper-pagination-bullet-active {
                background-color: #4F46E5; /* Warna titik aktif */
            }
        </style>
    </head>
    <body class="antialiased bg-gray-100">
        <div class="relative min-h-screen">
            {{-- Navigasi Atas --}}
            <div class="p-6 flex justify-between items-center">
                <a href="{{ route('home') }}" class="font-semibold text-gray-600 hover:text-gray-900">‹ Kembali ke Toko</a>
                <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900">Register</a>
                        @endif
                    @endauth
                @endif
                </div>
            </div>

            {{-- Konten Detail Produk --}}
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="flex flex-col md:flex-row -mx-4">
                    {{-- Kolom Kiri: Galeri Foto --}}
                    <div class="md:flex-1 px-4">
                        <div class="swiper product-swiper h-64 md:h-80 rounded-lg bg-gray-300 mb-4">
                            <div class="swiper-wrapper">
                                @forelse ($product->images as $image)
                                    <div class="swiper-slide flex items-center justify-center">
                                        <img class="h-full w-full object-cover" src="{{ asset('storage/' . $image->image_path) }}" alt="Foto produk {{ $product->name }}">
                                    </div>
                                @empty
                                    <div class="swiper-slide flex items-center justify-center bg-gray-200">
                                        <span class="text-gray-500">Tidak ada gambar</span>
                                    </div>
                                @endforelse
                            </div>
                            <!-- Tombol Navigasi -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <!-- Paginasi Titik-titik -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    {{-- Kolom Kanan: Info Produk --}}
                    <div class="md:flex-1 px-4">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }}</h2>
                        <div class="flex mb-4">
                            <div class="mr-4">
                                <span class="font-bold text-gray-700">Harga:</span>
                                <span class="text-gray-600 text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <div>
                                <span class="font-bold text-gray-700">Stok:</span>
                                <span class="text-gray-600">{{ $product->stock }}</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <span class="font-bold text-gray-700">Deskripsi Produk:</span>
                            <p class="text-gray-600 text-sm mt-2">
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Inisialisasi Swiper.js
            var swiper = new Swiper(".product-swiper", {
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                loop: true, // Agar bisa slide terus menerus
            });
        </script>
    </body>
</html>
