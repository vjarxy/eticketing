<x-app-layout>
    <nav
        class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <img src="{{ asset('images/waterboom.svg') }}" alt="Grand Waterboom">
                    </div>
                    <span class="text-xl font-bold text-gray-900">Grand Waterboom</span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Home</a>
                    <a href="#features"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Fitur</a>
                    <a href="#about"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Tentang</a>
                    <a href="#contact"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Kontak</a>
                </div>

                @guest
                    <div class="flex items-center space-x-4">
                        <a href="/auth/login"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Masuk</a>
                        <a href="/auth/register"
                            class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 font-medium shadow-lg hover:shadow-xl">Daftar</a>
                    </div>
                @else
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Keluar</button>
                        </form>
                    </div>
                @endguest

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-700 hover:text-blue-600 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home"
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-cyan-50 pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Sistem E-Ticketing
                        <span class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                            Grand Waterboom Maros
                        </span>
                    </h1>
                    <p class="text-lg sm:text-xl text-gray-600 mb-8 leading-relaxed">
                        Nikmati pengalaman pembelian tiket yang mudah, cepat, dan aman. Booking tiket waterboom
                        favoritmu hanya dengan beberapa klik.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="/register"
                            class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-8 py-4 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 font-semibold shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                            Mulai Sekarang
                        </a>
                        <a href="#features"
                            class="border-2 border-blue-500 text-blue-500 px-8 py-4 rounded-xl hover:bg-blue-500 hover:text-white transition-all duration-200 font-semibold">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <!-- Carousel Container -->
                    <div class="relative z-10 bg-white rounded-2xl shadow-2xl p-8">
                        <div class="relative overflow-hidden rounded-xl">
                            <!-- Carousel Wrapper -->
                            <div id="preview-carousel" class="relative w-full aspect-video">
                                <!-- Slide 1 - Dashboard Overview -->
                                <div
                                    class="carousel-slide active absolute inset-0 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-xl flex flex-col items-center justify-center p-6 transition-opacity duration-500">
                                    <svg class="w-16 h-16 text-blue-500 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Dashboard Analytics</h4>
                                    <p class="text-sm text-gray-600 text-center">Monitoring real-time penjualan dan
                                        statistik</p>
                                </div>

                                <!-- Slide 2 - Ticket Booking -->
                                <div class="carousel-slide absolute inset-0 bg-gradient-to-br from-green-100 to-emerald-100 rounded-xl flex flex-col items-center justify-center p-6 transition-opacity duration-500"
                                    style="opacity: 0;">
                                    <svg class="w-16 h-16 text-green-500 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Easy Booking</h4>
                                    <p class="text-sm text-gray-600 text-center">Sistem pemesanan tiket yang mudah dan
                                        cepat</p>
                                </div>

                                <!-- Slide 3 - Payment System -->
                                <div class="carousel-slide absolute inset-0 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl flex flex-col items-center justify-center p-6 transition-opacity duration-500"
                                    style="opacity: 0;">
                                    <svg class="w-16 h-16 text-purple-500 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Secure Payment</h4>
                                    <p class="text-sm text-gray-600 text-center">Berbagai metode pembayaran yang aman
                                    </p>
                                </div>

                                <!-- Slide 4 - Mobile App -->
                                <div class="carousel-slide absolute inset-0 bg-gradient-to-br from-orange-100 to-red-100 rounded-xl flex flex-col items-center justify-center p-6 transition-opacity duration-500"
                                    style="opacity: 0;">
                                    <svg class="w-16 h-16 text-orange-500 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Mobile Friendly</h4>
                                    <p class="text-sm text-gray-600 text-center">Responsif di semua perangkat mobile</p>
                                </div>
                            </div>

                            <!-- Carousel Indicators -->
                            <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex space-x-2">
                                <button
                                    class="carousel-indicator active w-2 h-2 bg-blue-500 rounded-full transition-all duration-200"
                                    data-slide="0"></button>
                                <button
                                    class="carousel-indicator w-2 h-2 bg-white/50 rounded-full transition-all duration-200"
                                    data-slide="1"></button>
                                <button
                                    class="carousel-indicator w-2 h-2 bg-white/50 rounded-full transition-all duration-200"
                                    data-slide="2"></button>
                                <button
                                    class="carousel-indicator w-2 h-2 bg-white/50 rounded-full transition-all duration-200"
                                    data-slide="3"></button>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Preview Sistem E-Ticketing</h3>
                            <p class="text-gray-600">Interface yang user-friendly dan fitur lengkap untuk semua
                                kebutuhan</p>
                        </div>
                    </div>

                    <!-- Background Elements -->
                    <div
                        class="absolute -top-4 -right-4 w-72 h-72 bg-gradient-to-r from-blue-200 to-cyan-200 rounded-full opacity-20 animate-pulse">
                    </div>
                    <div
                        class="absolute -bottom-4 -left-4 w-64 h-64 bg-gradient-to-r from-cyan-200 to-blue-200 rounded-full opacity-20 animate-pulse">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                    Sistem e-ticketing modern dengan fitur-fitur canggih untuk memberikan pengalaman terbaik
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Pembayaran Mudah</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Berbagai metode pembayaran yang aman dan terpercaya untuk kemudahan transaksi Anda.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Real-time Booking</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Cek ketersediaan tiket secara real-time dan booking langsung tanpa menunggu.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">E-Ticket Digital</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Tiket digital yang praktis dan ramah lingkungan, tinggal tunjukkan di smartphone Anda.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Manajemen Grup</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Booking untuk rombongan dengan mudah dan dapatkan harga spesial untuk grup.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Customer Support</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Tim support yang siap membantu Anda 24/7 untuk semua kebutuhan dan pertanyaan.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Analytics Dashboard</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dashboard analitik untuk monitoring penjualan dan performa bisnis secara real-time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                            Tentang Grand Waterboom Maros
                        </h2>
                        <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                            Grand Waterboom Maros adalah destinasi wisata air terbesar di Sulawesi Selatan yang
                            menawarkan pengalaman bermain air yang tak terlupakan untuk seluruh keluarga.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-6 h-6 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-gray-700">Wahana air yang beragam dan menantang</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-6 h-6 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-gray-700">Fasilitas modern dan keamanan terjamin</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-6 h-6 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-gray-700">Staff profesional dan berpengalaman</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-6 h-6 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-gray-700">Lokasi strategis dan mudah dijangkau</p>
                            </div>
                        </div>
                    </div>

                    <div class="order-1 lg:order-2 relative">
                        <div class="relative z-10">
                            <div class="bg-white rounded-2xl shadow-2xl p-8">
                                <div class="grid grid-cols-2 gap-6">
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-blue-600 mb-2">50K+</div>
                                        <div class="text-gray-600 text-sm">Pengunjung/Bulan</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-cyan-600 mb-2">15+</div>
                                        <div class="text-gray-600 text-sm">Wahana Air</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-blue-600 mb-2">24/7</div>
                                        <div class="text-gray-600 text-sm">Customer Support</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-cyan-600 mb-2">4.8★</div>
                                        <div class="text-gray-600 text-sm">Rating Pengguna</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute -top-6 -right-6 w-64 h-64 bg-gradient-to-r from-blue-200 to-cyan-200 rounded-full opacity-20 animate-pulse">
                        </div>
                        <div
                            class="absolute -bottom-6 -left-6 w-56 h-56 bg-gradient-to-r from-cyan-200 to-blue-200 rounded-full opacity-20 animate-pulse">
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-cyan-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
                Siap Memulai Petualangan Air Anda?
            </h2>
            <p class="text-lg sm:text-xl text-blue-100 mb-8 leading-relaxed">
                Bergabunglah dengan ribuan pengunjung yang sudah merasakan kemudahan sistem e-ticketing kami
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register"
                    class="bg-white text-blue-600 px-8 py-4 rounded-xl hover:bg-gray-100 transition-all duration-200 font-semibold shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                    Daftar Sekarang
                </a>
                <a href="#contact"
                    class="border-2 border-white text-white px-8 py-4 rounded-xl hover:bg-white hover:text-blue-600 transition-all duration-200 font-semibold">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-2 mb-6">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold">Grand Waterboom Maros</span>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed max-w-md">
                        Sistem informasi e-ticketing berbasis web yang modern dan mudah digunakan untuk Grand Waterboom
                        Maros.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.758-1.378l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001 12.017.001z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.1 0C5.6 0 .4 5.2.4 11.6c0 5.1 3.3 9.4 7.8 10.9.6.1.8-.2.8-.5v-1.9c-3.2.7-3.9-1.5-3.9-1.5-.5-1.3-1.2-1.6-1.2-1.6-1-.7.1-.7.1-.7 1.1.1 1.7 1.1 1.7 1.1 1 1.7 2.6 1.2 3.2.9.1-.7.4-1.2.7-1.5-2.5-.3-5.1-1.2-5.1-5.4 0-1.2.4-2.2 1.1-2.9-.1-.3-.5-1.4.1-2.9 0 0 .9-.3 3 1.1.9-.2 1.8-.4 2.7-.4.9 0 1.8.1 2.7.4 2.1-1.4 3-1.1 3-1.1.6 1.5.2 2.6.1 2.9.7.7 1.1 1.7 1.1 2.9 0 4.2-2.6 5.1-5.1 5.4.4.3.8 1 .8 2v3c0 .3.2.6.8.5 4.5-1.5 7.8-5.8 7.8-10.9-.1-6.4-5.3-11.6-11.8-11.6z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-6">Navigasi</h3>
                    <ul class="space-y-3">
                        <li><a href="#home"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Home</a></li>
                        <li><a href="#features"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Fitur</a></li>
                        <li><a href="#about"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Tentang</a></li>
                        <li><a href="/login"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Masuk</a></li>
                        <li><a href="/register"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Daftar</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-6">Kontak</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-gray-300">Jl. Poros Makassar-Maros, Maros, Sulawesi Selatan</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-gray-300">+62 123 456 789</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-300">info@grandwaterboommaros.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p class="text-gray-400">
                    © 2025 Grand Waterboom Maros. All rights reserved. | Sistem E-Ticketing by
                    <span class="text-blue-400">Tim Developer</span>
                </p>
            </div>
        </div>
    </footer>
</x-app-layout>
