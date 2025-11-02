@extends('layout.app')

@section('title', 'About Us')

@section('content')
<div class="max-w-4xl mx-auto py-16 px-6 text-center">
    <h1 class="text-4xl font-bold mb-6 text-blue-600">About MailME</h1>

    <p class="text-gray-700 leading-relaxed mb-8">
        MailME is a personalized daily reflection and motivation service.
        Every morning, you receive a thoughtful message crafted just for you —
        based on your character, interests, and beliefs.  
        Our goal is to inspire self-growth, mindfulness, and positivity through meaningful words.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
        <div class="bg-white p-6 shadow-md rounded-2xl">
            <h3 class="text-xl font-semibold text-blue-500 mb-2">✨ Personal Growth</h3>
            <p class="text-gray-600 text-sm">Start your day with a reflection that encourages awareness and motivation.</p>
        </div>
        <div class="bg-white p-6 shadow-md rounded-2xl">
            <h3 class="text-xl font-semibold text-blue-500 mb-2">💌 Smart Messages</h3>
            <p class="text-gray-600 text-sm">AI-generated content tailored to your personality and preferences.</p>
        </div>
        <div class="bg-white p-6 shadow-md rounded-2xl">
            <h3 class="text-xl font-semibold text-blue-500 mb-2">🌍 Our Mission</h3>
            <p class="text-gray-600 text-sm">We aim to spread positivity and thoughtful communication across the world.</p>
        </div>
    </div>

    <a href="{{ route('user.home') }}" 
       class="inline-block mt-10 px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
        Back to Home
    </a>
</div>
@endsection
