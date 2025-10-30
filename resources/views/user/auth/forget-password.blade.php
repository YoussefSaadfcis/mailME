@extends('layout.app')

@section('title', 'Forgot Password')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-8">
    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">
        Forgot Your Password?
    </h2>

    <p class="text-gray-600 text-center mb-6">
        Enter your email address and we'll send you a verification code to reset your password.
    </p>

    <form action="{{route('password.reset.otp')}}" method="POST" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                   required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Send Code
        </button>

        <div class="text-center text-sm mt-4">
            <a href="{{ route('signin.get') }}" class="text-blue-600 hover:underline">Back to Sign In</a>
        </div>
    </form>
</div>
@endsection
