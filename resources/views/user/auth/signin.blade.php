@extends('layout.app')

@section('title', 'Sign In')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-8">
    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Welcome Back to mailME</h2>

    <form action="{{ route('signin.post') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                   required autofocus>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                   required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember me + Forgot password --}}
        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="mr-2 text-blue-600 border-gray-300 rounded">
                Remember me
            </label>

            <a href="{{ route('password.reset.request') }}" class="text-blue-600 hover:underline">
                Forgot Password?
            </a>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Sign In
        </button>

        <div class="text-center text-sm mt-4">
            Don’t have an account?
            <a href="{{ route('signup.create') }}" class="text-blue-600 hover:underline">Sign up here</a>
        </div>
    </form>
</div>
@endsection
