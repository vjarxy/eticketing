<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin {{ $title ?? 'Dashboard' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{ $styles ?? '' }}
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Added sidebar navigation for admin -->
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 min-h-screen p-4">
            <div class="flex items-center mb-8">
                <i class="fas fa-ticket-alt text-2xl mr-3"></i>
                <h1 class="text-xl font-bold">Admin Panel</h1>
            </div>

            <nav class="space-y-2">
                <a href="/admin/dashboard" class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>

                <a href="{{ route('users.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('users.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    Users
                </a>

                <a href="/admin/tickets" class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('tickets.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-ticket-alt mr-3"></i>
                    Tickets
                </a>

                <div class="border-t border-gray-600 my-4"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center p-3 rounded-lg hover:bg-gray-700 w-full text-left">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Added top header bar -->
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-gray-800">{{ $title ?? 'Dashboard' }}</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Welcome, {{ auth()->user()->name }}</span>
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Added main content area with proper scrolling -->
            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if(session('success'))
                    <div class="mb-4">
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('error') }}
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    {{ $scripts ?? '' }}
</body>
</html>
