@extends('layout.app')

@section('title', 'Change Password')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-8">
    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">
        Set a New Password
    </h2>

    <p class="text-gray-600 text-center mb-6">
        Please enter your new password below. Make sure it’s strong and secure.
    </p>

    <form action="{{ route('changePassword.post',$id) }}" method="POST" class="space-y-4">
        @csrf

        {{-- Hidden field (if you pass the email or token) --}}
        <input type="hidden" name="email" value="{{ $email ?? '' }}">

        {{-- New Password --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
            <input type="password" name="password"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                   required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Update Password
        </button>

        <div class="text-center text-sm mt-4">
            <a href="{{ route('signin.get') }}" class="text-blue-600 hover:underline">Back to Sign In</a>
        </div>
    </form>
</div>
@endsection
