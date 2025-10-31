@extends('layout.app')

@section('title', 'Your Character - mailME')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 mt-8">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">Define Your Character</h2>
        <p class="text-center text-gray-600 mb-8">
            Let’s understand you better so we can send messages that truly inspire you.
        </p>

        {{-- Show global validation errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.character') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Mood Style --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Your Mood Style</label>
                <div class="grid grid-cols-2 gap-3">
                    @foreach (['Optimistic', 'Calm', 'Ambitious', 'Reflective'] as $option)
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-blue-50">
                            <input type="radio" name="mood" value="{{ $option }}" class="mr-2"
                                {{ old('mood', optional($user->character)->mood) == $option ? 'checked' : '' }}>
                            {{ $option }}
                        </label>
                    @endforeach
                </div>
                @error('mood')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Motivation Type --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">What motivates you most?</label>
                <div class="grid grid-cols-2 gap-3">
                    @foreach (['Growth & Success', 'Peace & Balance', 'Faith & Gratitude', 'Creativity & Passion'] as $option)
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-blue-50">
                            <input type="radio" name="motivation" value="{{ $option }}" class="mr-2"
                                {{ old('motivation', optional($user->character)->motivation) == $option ? 'checked' : '' }}>
                            {{ $option }}
                        </label>
                    @endforeach
                </div>
                @error('motivation')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Religion --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Religion</label>
                <select name="religion" class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    <option disabled {{ old('religion', optional($user->character)->religion) ? '' : 'selected' }}>Select
                        religion</option>
                    @foreach (['Islam', 'Christianity', 'Prefer not to say'] as $option)
                        <option value="{{ $option }}"
                            {{ old('religion', optional($user->character)->religion) == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                @error('religion')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                <label class="mt-2 flex items-center">
                    <input type="hidden" name="allow_religion_use" value="0">
                    <input type="checkbox" name="allow_religion_use" value="1"
                        {{ old('allow_religion_use', optional($user->character)->allow_religion_use) ? 'checked' : '' }}>
                    <span class="ml-2">Allow mailME to use my religion to generate quotes or reflections</span>
                </label>
            </div>

            {{-- About Section --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Tell us more about yourself</label>
                <textarea name="about" rows="4" class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500">{{ old('about', optional($user->character)->about) }}</textarea>
                @error('about')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Save --}}
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                Save & Continue
            </button>
        </form>
    </div>
@endsection
