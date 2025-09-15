<x-app-layout>
    <main class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full space-y-8">
            <!-- Waterboom Card Container -->
            <div
                class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8 relative overflow-hidden">
                <!-- Decorative water splash at top -->
                <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-cyan-500 via-blue-400 to-teal-500">
                </div>

                <!-- Header with waterboom branding -->
                <div class="text-center">
                    <!-- Waterboom Logo/Icon -->
                    <div
                        class="mx-auto h-20 w-20 bg-gradient-to-br from-cyan-500 to-teal-400 rounded-full flex items-center justify-center shadow-lg mb-4 relative">
                        <!-- Swimming icon -->
                        <svg class="h-10 w-10 text-white drop-shadow-sm" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M2 17h20v2H2zm1.15-4.05L4 11.47l.85 1.48c.38.66 1.08 1.05 1.85 1.05s1.47-.39 1.85-1.05L9.4 11.47c.38-.66 1.08-1.05 1.85-1.05s1.47.39 1.85 1.05l.85 1.48.85-1.48c.38-.66 1.08-1.05 1.85-1.05s1.47.39 1.85 1.05l.85 1.48.85-1.48c.38-.66 1.08-1.05 1.85-1.05s1.47.39 1.85 1.05L22 12.95l-.85 1.48c-.38.66-1.08 1.05-1.85 1.05s-1.47-.39-1.85-1.05L16.6 12.95c-.38-.66-1.08-1.05-1.85-1.05s-1.47.39-1.85 1.05l-.85 1.48-.85-1.48c-.38-.66-1.08-1.05-1.85-1.05s-1.47.39-1.85 1.05L7.4 14.43c-.38.66-1.08 1.05-1.85 1.05s-1.47-.39-1.85-1.05L3.15 13zm-.85-1.48L3.15 10c.38-.66 1.08-1.05 1.85-1.05s1.47.39 1.85 1.05l.85 1.47.85-1.47C8.93 9.34 9.63 8.95 10.4 8.95s1.47.39 1.85 1.05l.85 1.47.85-1.47c.38-.66 1.08-1.05 1.85-1.05s1.47.39 1.85 1.05l.85 1.47.85-1.47c.38-.66 1.08-1.05 1.85-1.05s1.47.39 1.85 1.05L22 11.47l-.85 1.48c-.38.66-1.08 1.05-1.85 1.05s-1.47-.39-1.85-1.05L16.6 11.47c-.38-.66-1.08-1.05-1.85-1.05s-1.47.39-1.85 1.05l-.85 1.48-.85-1.48c-.38-.66-1.08-1.05-1.85-1.05s-1.47.39-1.85 1.05L7.4 12.95c-.38.66-1.08 1.05-1.85 1.05s-1.47-.39-1.85-1.05L2.3 11.47zM12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                        </svg>
                        <!-- Shine effect -->
                        <div class="absolute top-2 left-2 w-3 h-3 bg-white/30 rounded-full"></div>
                    </div>

                    <h1 class="text-2xl font-bold text-gray-800 mb-2">🌊 WATERBOOM 🏊‍♂️</h1>
                    <h2 class="text-xl font-semibold text-gray-700 mb-1">Bergabung dengan Keluarga Waterboom!</h2>
                    <p class="text-sm text-gray-600 mb-6">
                        Daftar sekarang dan nikmati wahana air seru
                    </p>
                    <p class="text-xs text-gray-500">
                        Sudah punya akun?
                        <a href="/auth/login" class="font-medium text-cyan-600 hover:text-cyan-500 transition-colors">
                            Masuk sekarang
                        </a>
                    </p>
                </div>

                <!-- Form -->
                <form method="POST" action="/auth/register" class="mt-6 space-y-5">
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
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                👤 Nama Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-teal-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="block w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 bg-white/80 @error('name') border-red-300 focus:ring-red-400 focus:border-red-400 @enderror"
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                📧 Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-teal-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                        </path>
                                    </svg>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="block w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 bg-white/80 @error('email') border-red-300 focus:ring-red-400 focus:border-red-400 @enderror"
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
                                    <svg class="h-5 w-5 text-teal-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="password" name="password" id="password" required
                                    class="block w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 bg-white/80 @error('password') border-red-300 focus:ring-red-400 focus:border-red-400 @enderror"
                                    placeholder="Minimal 8 karakter">
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @else
                                <p class="mt-1 text-xs text-gray-500">
                                    💡 Gunakan minimal 8 karakter untuk keamanan
                                </p>
                            @enderror
                        </div>

                        <!-- Password Confirmation Field -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                ✅ Konfirmasi Kata Sandi
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-teal-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    required
                                    class="block w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 bg-white/80 @error('password_confirmation') border-red-300 focus:ring-red-400 focus:border-red-400 @enderror"
                                    placeholder="Ketik ulang kata sandi">
                            </div>
                            @error('password_confirmation')
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
                            class="group relative w-full flex justify-center py-4 px-6 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                                <svg class="h-5 w-5 text-teal-200 group-hover:text-white transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                    </path>
                                </svg>
                            </span>
                            🎉 Bergabung dengan Waterboom
                        </button>
                    </div>
                </form>

                <!-- Fun Footer -->
                <div class="text-center mt-6 p-4 bg-gradient-to-r from-teal-50 to-cyan-50 rounded-xl">
                    <p class="text-xs text-gray-600">
                        🌊 Bergabung dengan ribuan pengunjung yang sudah merasakan keseruan! 🎢
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Wahana air terbaru, kolam renang olympic, dan banyak lagi!
                    </p>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
