<x-app-layout>
    <main class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full space-y-8">
            <!-- Waterboom Card Container -->
            <div
                class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8 relative overflow-hidden">
                <!-- Decorative water splash at top -->
                <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-500 via-cyan-400 to-blue-600">
                </div>

                <!-- Header with waterboom branding -->
                <div class="text-center">
                    <!-- Waterboom Logo/Icon -->
                    <div
                        class="mx-auto h-20 w-20 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-full flex items-center justify-center shadow-lg mb-4 relative">
                        <!-- Water drop icon -->
                        <svg class="h-10 w-10 text-white drop-shadow-sm" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.1 5.8 6 9.3 6 12.5c0 3.3 2.7 6 6 6s6-2.7 6-6C18 9.3 15.9 5.8 12 2zm0 14c-2.2 0-4-1.8-4-4 0-1.7 1.2-3.6 4-6.2 2.8 2.6 4 4.5 4 6.2 0 2.2-1.8 4-4 4z" />
                        </svg>
                        <!-- Shine effect -->
                        <div class="absolute top-2 left-2 w-3 h-3 bg-white/30 rounded-full"></div>
                    </div>

                    <h1 class="text-2xl font-bold text-gray-800 mb-2">🌊 WATERBOOM 🏊‍♂️</h1>
                    <h2 class="text-xl font-semibold text-gray-700 mb-1">Selamat Datang Kembali!</h2>
                    <p class="text-sm text-gray-600 mb-6">
                        Masuk untuk menikmati wahana air seru kami
                    </p>
                    <p class="text-xs text-gray-500">
                        Belum punya akun?
                        <a href="/auth/register"
                            class="font-medium text-cyan-600 hover:text-cyan-500 transition-colors">
                            Daftar sekarang
                        </a>
                    </p>
                </div>

                <!-- Form -->
                <form method="POST" action="/auth/login" class="mt-6 space-y-5">
                    @csrf

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-400 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Ops! Ada yang salah:</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc space-y-1 pl-5">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="space-y-4">
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                📧 Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                        </path>
                                    </svg>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="block w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200 bg-white/80 @error('email') border-red-300 focus:ring-red-400 focus:border-red-400 @enderror"
                                    placeholder="contoh@email.com">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                🔐 Kata Sandi
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="password" name="password" id="password" required
                                    class="block w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200 bg-white/80 @error('password') border-red-300 focus:ring-red-400 focus:border-red-400 @enderror"
                                    placeholder="Masukkan kata sandi">
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                            class="group relative w-full flex justify-center py-4 px-6 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                                <svg class="h-5 w-5 text-blue-200 group-hover:text-white transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                    </path>
                                </svg>
                            </span>
                            🏊‍♂️ Masuk ke Waterboom
                        </button>
                    </div>
                </form>

                <!-- Fun Footer -->
                <div class="text-center mt-6 p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl">
                    <p class="text-xs text-gray-600">
                        🌊 Siap untuk keseruan di taman air terbesar? 🎢
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Nikmati wahana seru dan berbagai fasilitas menarik!
                    </p>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
