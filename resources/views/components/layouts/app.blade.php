<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - {{ $title ?? 'E-Ticket System' }}</title>

    <!-- Replaced Bootstrap with Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{ $styles ?? '' }}
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Updated navigation to use Tailwind classes -->
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-white font-bold text-xl">
                        <i class="fas fa-ticket-alt mr-2"></i>E-Ticket System
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('users.index') }}"
                                class="text-white hover:text-blue-200 px-3 py-2 rounded-md">
                                <i class="fas fa-users mr-1"></i>Users
                            </a>
                            <a href="{{ route('tickets.index') }}"
                                class="text-white hover:text-blue-200 px-3 py-2 rounded-md">
                                <i class="fas fa-ticket-alt mr-1"></i>Tickets
                            </a>
                        @elseif(auth()->user()->role === 'petugas')
                            <a href="{{ url('petugas/dashboard') }}"
                                class="text-white hover:text-blue-200 px-3 py-2 rounded-md">
                                <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'pengunjung')
                            <a href="{{ url('transaksi') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md">
                                <i class="fas fa-shopping-cart mr-1"></i>Transaksi
                            </a>
                        @endif
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md">
                            <i class="fas fa-sign-in-alt mr-1"></i>Login
                        </a>
                        <a href="{{ url('auth/register') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md">
                            <i class="fas fa-user-plus mr-1"></i>Register
                        </a>
                    @else
                        <div class="relative group">
                            <button class="text-white hover:text-blue-200 px-3 py-2 rounded-md flex items-center">
                                <i class="fas fa-user-circle mr-1"></i>{{ auth()->user()->name }}
                                <i class="fas fa-chevron-down ml-1"></i>
                            </button>
                            <div
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                <div class="py-1">
                                    <span
                                        class="block px-4 py-2 text-sm text-gray-500">{{ ucfirst(auth()->user()->role) }}</span>
                                    <hr class="my-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Updated main content area with Tailwind classes -->
    <main class="py-6">
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('error') }}
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    <!-- Updated footer with Tailwind classes -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h5 class="text-lg font-bold"><i class="fas fa-ticket-alt mr-2"></i>E-Ticket System</h5>
                    <p class="text-gray-400">Sistem manajemen tiket elektronik yang mudah dan efisien.</p>
                </div>
                <div>
                    <p class="text-gray-400">&copy; {{ date('Y') }} E-Ticket System. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    {{ $scripts ?? '' }}
</body>

</html>
