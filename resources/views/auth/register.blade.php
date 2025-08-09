<!-- File: resources/views/auth/register.blade.php -->

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- TAMBAHKAN KODE INI -->
        <div class="mt-4">
            <x-input-label :value="__('Daftar Sebagai')" />
            <div class="flex items-center mt-2">
                <input id="role_pembeli" type="radio" name="role" value="pembeli" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500" checked>
                <label for="role_pembeli" class="ml-2 block text-sm text-gray-900">
                    Pembeli
                </label>
            </div>
            <div class="flex items-center mt-2">
                <input id="role_penjual" type="radio" name="role" value="penjual" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                <label for="role_penjual" class="ml-2 block text-sm text-gray-900">
                    Penjual
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
        <!-- BATAS AKHIR KODE TAMBAHAN -->


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
