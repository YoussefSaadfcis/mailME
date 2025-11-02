@extends('layout.app')

@section('title', 'Welcome to mailME')

@section('content')
<div class="min-h-[80vh] flex flex-col justify-center items-center text-center bg-gradient-to-br from-blue-50 via-white to-blue-100 rounded-2xl shadow-inner p-8">
    
    {{-- Quote / Hero Section --}}
    <h1 class="text-4xl font-bold text-blue-700 mb-4">
        “Connect with meaning, not just messages.”
    </h1>
    <p class="text-gray-600 max-w-xl mb-8">
        mailME helps you express who you are through your words — 
        define your character, verify your identity, and communicate authentically.
    </p>

    {{-- Main CTA --}}
    <a href="{{ route('user.character') }}" 
       class="bg-blue-600 text-white px-8 py-3 rounded-full text-lg shadow-lg hover:bg-blue-700 transition">
        ✏️ Set Your Character Description
    </a>
</div>

{{-- Mission Section --}}
<div class="max-w-4xl mx-auto text-center mt-16 mb-8 px-6">
    <h2 class="text-2xl font-semibold text-blue-700 mb-3">Our Mission</h2>
    <p class="text-gray-600">
        At <span class="font-semibold text-blue-600">mailME</span>, we believe identity is more than an email address.
        We're building a community where messages reflect integrity, trust, and personality.
    </p>
</div>

{{-- Optional Footer --}}
<footer class="border-t mt-16 py-6 text-center text-sm text-gray-500">
    <p>&copy; {{ date('Y') }} mailME. All rights reserved.</p>
    <div class="space-x-4 mt-2">
        <a href="{{route('user.about')}}" class="hover:text-blue-600">About</a>
        <a href="#" class="hover:text-blue-600">Contact</a>
        <a href="#" class="hover:text-blue-600">Privacy Policy</a>
    </div>
</footer>
@endsection
