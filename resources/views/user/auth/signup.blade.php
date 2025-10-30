@extends('layout.app')

@section('title', 'Sign Up')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-8">
    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Create Your mailME Account</h2>

    <form action="{{ route('signup.store') }}" method="POST" class="space-y-4">
        @csrf

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

        <div class="text-center text-sm mt-4">
            Already have an account?
            <a href={{route("signin.get")}} class="text-blue-600 hover:underline">Login here</a>
        </div>
    </form>
</div>
@endsection
