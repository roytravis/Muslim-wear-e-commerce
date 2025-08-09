{{-- File: resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('status'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- GANTI KONTEN DASHBOARD --}}
                    @if(Auth::user()->role == 'penjual')
                        <h3 class="text-lg font-medium">Selamat Datang, Penjual!</h3>
                        <p class="mt-1">Anda sekarang dapat mengelola produk Anda.</p>
                        <div class="mt-4">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Kelola Produk Saya
                            </a>
                        </div>
                    @else
                        <h3 class="text-lg font-medium">Selamat Datang di Marketplace Kami!</h3>
                        <p class="mt-1">Jelajahi berbagai produk menarik dari penjual-penjual terbaik kami.</p>
                    @endif
                    {{-- BATAS AKHIR PERUBAHAN --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
