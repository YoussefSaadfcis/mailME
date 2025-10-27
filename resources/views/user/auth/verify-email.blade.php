@extends('layout.app')

@section('title', 'Verify Email')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-8">
    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Verify Your Email</h2>

    <form action="{{ route('verify.email.otp', $id) }}" method="POST">
        @csrf
        <label class="block text-sm font-medium text-gray-700 mb-1">Enter OTP</label>
        <input type="text" name="otp" maxlength="6" class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>

        @error('otp')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button type="submit" class="w-full mt-4 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Verify
        </button>
    </form>
</div>
@endsection
