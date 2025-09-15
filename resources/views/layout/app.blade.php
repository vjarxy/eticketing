<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'E-Ticketing' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <a href="{{ url('/') }}" class="font-bold">Grand Waterboom Maros</a>
            <div>
                @auth
                    <span>Halo, {{ Auth::user()->name }}</span>
                    <form action="{{ url('/logout') }}" method="POST" class="inline">
                        @csrf
                        <button class="ml-2 underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mr-2">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>
</body>

</html>
