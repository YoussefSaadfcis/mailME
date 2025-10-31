@extends('layout.app')

@section('title', 'Sign Up')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-8">
    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Create Your mailME Account</h2>

    <form action="{{ route('signup.store') }}" method="POST" class="space-y-4">
        @csrf

              {{--  Error Alert --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
                {{ session()->forget('error') }}
            </div>
        @endif
        {{-- Name --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" 
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password + Confirmation --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" 
                       class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" 
                       class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        {{-- Birthdate --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Birthdate</label>
            <input type="date" name="birthdate" value="{{ old('birthdate') }}" 
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 @error('birthdate') border-red-500 @enderror" required>
            @error('birthdate')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Sign Up
        </button>

        {{-- Google Sign Up --}}
        <a href="{{ route('google.redirect') }}"
        class="w-full flex items-center justify-center bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.84-6.84C35.52 2.69 30.12.5 24 .5 14.95.5 7.07 5.86 3.2 13.32l7.98 6.2C12.95 13.58 17.96 9.5 24 9.5z"/><path fill="#34A853" d="M46.1 24.5c0-1.6-.14-3.13-.4-4.62H24v9.16h12.4c-.54 2.9-2.14 5.36-4.54 7.06l7.04 5.47C43.78 38.24 46.1 31.9 46.1 24.5z"/><path fill="#FBBC05" d="M11.18 28.52A13.45 13.45 0 0 1 10.5 24c0-1.57.28-3.08.68-4.52L3.2 13.32A23.93 23.93 0 0 0 0 24c0 3.84.92 7.45 2.52 10.68l8.66-6.16z"/><path fill="#4285F4" d="M24 48c6.12 0 11.26-2.02 15.02-5.5l-7.04-5.47c-1.95 1.32-4.44 2.1-7.98 2.1-6.04 0-11.05-4.08-12.82-9.68l-8.66 6.16C7.07 42.14 14.95 48 24 48z"/></svg>
        Sign in with Google
        </a>


        <div class="text-center text-sm mt-4">
            Already have an account?
            <a href={{route("signin.get")}} class="text-blue-600 hover:underline">Login here</a>
        </div>
    </form>
</div>
@endsection
