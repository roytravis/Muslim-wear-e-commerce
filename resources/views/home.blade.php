{{-- File: resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Marketplace Baju</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-100">
        <div class="relative min-h-screen">
            <div class="p-6 text-right">
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

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Marketplace Baju</h1>
                    <p class="mt-4 text-lg leading-8 text-gray-600">Temukan gaya terbaikmu di sini.</p>
                </div>

                {{-- Grid untuk Produk --}}
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    @foreach ($products as $product)
                        <a href="{{ route('product.show', $product) }}" class="group">
                            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                {{-- Tampilkan gambar pertama dari produk --}}
                                @if($product->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center group-hover:opacity-75">
                                @else
                                    {{-- Gambar placeholder jika tidak ada foto --}}
                                    <div class="h-full w-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                            </div>
                            <h3 class="mt-4 text-sm text-gray-700">{{ $product->name }}</h3>
                            <p class="mt-1 text-lg font-medium text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
