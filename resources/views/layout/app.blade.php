<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'mailME')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    {{-- 🌐 Header --}}
    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">
                <a href="{{route("user.home")}}">mailME</a>
            </h1>
            @auth
                <div class="ml-auto mr-6 text-md font-semibold text-gray-600">
                    Welcome,{{ Auth::user()->name }}!
                </div>
            @endauth
              
            <nav>
                <ul class="flex gap-6">
                    <li><a href="{{route('user.home')}}" class="hover:text-blue-500">Home</a></li>
                    <li><a href="{{route('user.about')}}" class="hover:text-blue-500">About</a></li>
                    <li><a href="{{route('user.character')}}" class="hover:text-blue-500">Profile</a></li>
                    @guest
                        <li><a href="{{ route('signin.get') }}" class="hover:text-blue-500">Login</a></li>
                    @endguest
                    @auth
                        <li><a href="{{ route('logout') }}" class="hover:text-blue-500">Logout</a></li>
                    @endauth
                  
                </ul>
            </nav>
        </div>
    </header>

    {{-- 🧩 Main Page Content --}}
    <main class="flex-1 container mx-auto px-6 py-8">
        @yield('content')
    </main>

    {{-- ⚓ Footer --}}
    <footer class="bg-gray-200 py-4 text-center text-gray-600">
        &copy; {{ date('Y') }} mailME — Your daily AI motivation 💌
    </footer>

</body>

</html>
