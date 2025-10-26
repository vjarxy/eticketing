<x-app-layout>
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
                        @auth
                            <a href="{{ route('tickets.index') }}"
                                class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-8 py-4 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 font-semibold shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                                <i class="fas fa-ticket-alt mr-2"></i>
                                Beli Tiket Sekarang
                            </a>
                            <a href="{{ route('cart.index') }}"
                                class="border-2 border-blue-500 text-blue-500 px-8 py-4 rounded-xl hover:bg-blue-500 hover:text-white transition-all duration-200 font-semibold">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Lihat Keranjang
                            </a>
                        @else
                            <a href="/auth/register"
                                class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-8 py-4 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 font-semibold shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                                Mulai Sekarang
                            </a>
                            <a href="#features"
                                class="border-2 border-blue-500 text-blue-500 px-8 py-4 rounded-xl hover:bg-blue-500 hover:text-white transition-all duration-200 font-semibold">
                                Pelajari Lebih Lanjut
                            </a>
                        @endauth
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
                                    <p class="text-sm text-gray-600 text-center">Responsif di semua perangkat mobile
                                    </p>
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

    <!-- Banner Promo Section -->
    <section id="promo" class="py-12 bg-gradient-to-br from-blue-50 via-white to-cyan-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

        <!-- Kolom Banner (Swiper) -->
        <div class="swiper promoSwiper w-full max-w-md">
            <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <img src="/images/banner1.jpg" 
                    alt="Promo Tiket 1" 
                    class="w-full h-150 object-cover rounded-2xl shadow-xl border-4 border-white">
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide">
                <img src="/images/banner2.jpg" 
                    alt="Promo Tiket 2" 
                    class="w-full h-150 object-cover rounded-2xl shadow-xl border-4 border-white">
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide">
                <img src="/images/banner3.jpg" 
                    alt="Promo Tiket 3" 
                    class="w-full h-150 object-cover rounded-2xl shadow-xl border-4 border-white">
            </div>
            </div>

            <!-- Pagination (Titik) -->
            <div class="swiper-pagination mt-4"></div>
        </div>

        <!-- Kolom Keterangan (Statis) -->
        <div class="text-center md:text-left">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
            🎉 Promo Spesial Akhir Pekan
            </h2>
            <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                Nikmati berbagai penawaran menarik untuk setiap pembelian tiket online. 
            </p>
            <a href="{{ route('tickets.index') }}"
            class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-8 py-4 rounded-xl 
                    hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 font-semibold 
                    shadow-lg hover:shadow-2xl transform hover:-translate-y-1 inline-block">
            Pesan Sekarang
            </a>
        </div>
        </div>
    </div>
    </section>

    <!-- SwiperJS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        new Swiper(".promoSwiper", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        });
    });
    </script>

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
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gradient-to-br from-blue-100 to-cyan-100 rounded-2xl p-6 text-center">
                                <div class="text-3xl font-bold text-blue-600 mb-2">15+</div>
                                <div class="text-gray-700">Wahana Air</div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-100 to-cyan-100 rounded-2xl p-6 text-center">
                                <div class="text-3xl font-bold text-green-600 mb-2">50K+</div>
                                <div class="text-gray-700">Pengunjung/Bulan</div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-100 to-cyan-100 rounded-2xl p-6 text-center">
                                <div class="text-3xl font-bold text-purple-600 mb-2">4.8★</div>
                                <div class="text-gray-700">Rating Google</div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-100 to-cyan-100 rounded-2xl p-6 text-center">
                                <div class="text-3xl font-bold text-orange-600 mb-2">24/7</div>
                                <div class="text-gray-700">Customer Care</div>
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
    </section>

    <!-- Statistik Section -->
<section id="statistik" class="py-12 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-8 text-center">
      📊 Statistik Pengunjung
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Hari Paling Ramai -->
      <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-6 rounded-2xl shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Hari Paling Ramai</h3>
        <p class="text-2xl font-bold text-blue-600">{{ $hariRamai }}</p>
        <p class="text-sm text-gray-500 mt-1">Berdasarkan data 30 hari terakhir</p>
      </div>

      <!-- Rata-rata Pengunjung Per Hari -->
      <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-6 rounded-2xl shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Rata-rata / Hari</h3>
        <p class="text-2xl font-bold text-blue-600">{{ $rataPengunjung }}</p>
        <p class="text-sm text-gray-500 mt-1">Pengunjung setiap harinya</p>
      </div>

      <!-- Total Bulan Ini -->
      <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-6 rounded-2xl shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $bulanSekarang }}</h3>
        <p class="text-2xl font-bold text-blue-600">{{ $totalBulanIni }}</p>
        <p class="text-sm text-gray-500 mt-1">Total pengunjung bulan ini</p>
      </div>
    </div>
  </div>
</section>

    <section id="wahana" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Wahana Seru</h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
                    Nikmati berbagai wahana air seru yang siap memberikan pengalaman tak terlupakan
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Wahana 1 -->
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl shadow-lg p-6 text-center">
                    <img src="/images/seluncuran.jpeg" alt="Seluncuran Air" class="w-full h-48 object-cover rounded-xl mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Seluncuran Air Raksasa</h3>
                    <p class="text-gray-600">Rasakan adrenalin di seluncuran air dengan tinggi belasan meter.</p>
                </div>

                <!-- Wahana 2 -->
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl shadow-lg p-6 text-center">
                    <img src="/images/kolam.jpeg" alt="Kolam Anak" class="w-full h-48 object-cover rounded-xl mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Kolam Anak</h3>
                    <p class="text-gray-600">Kolam khusus anak-anak dengan permainan yang aman dan seru.</p>
                </div>

                <!-- Wahana 3 -->
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl shadow-lg p-6 text-center">
                    <img src="/images/ombak.jpg" alt="Kolam Ombak" class="w-full h-48 object-cover rounded-xl mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Kolam Ombak</h3>
                    <p class="text-gray-600">Nikmati sensasi ombak buatan layaknya di pantai tropis.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="galeri" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Galeri</h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
                    Suasana seru dan momen kebersamaan di Grand Waterboom Maros
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <img src="/images/suasana1.jpg" class="w-full h-48 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" alt="Galeri 1">
                <img src="/images/suasana2.jpeg" class="w-full h-48 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" alt="Galeri 2">
                <img src="/images/suasana3.jpeg" class="w-full h-48 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" alt="Galeri 3">
                <img src="/images/suasana4.jpg" class="w-full h-48 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" alt="Galeri 4">
            </div>
        </div>
    </section>

    <!-- Paket Tiket Section -->
    <section id="tiket" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Paket Tiket Tersedia</h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
                    Pilih paket yang sesuai dengan kebutuhan dan budget Anda
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Tiket Reguler -->
                <div
                    class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-500 to-cyan-500"></div>
                    <div class="p-8">
                        <div class="text-center mb-6">
                            <div
                                class="w-16 h-16 bg-gradient-to-r from-blue-100 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                        </div>

                        <div class="text-center mb-8">
                            <div class="text-4xl font-bold text-gray-900 mb-2">
                                Rp 20.000
                                <span class="text-lg font-normal text-gray-500">/orang</span>
                            </div>
                            <div class="text-sm text-gray-500">Weekday (Senin - Jumat)</div>
                        </div>

                        @auth
                            <a href="{{ route('tickets.index') }}"
                                class="block w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-3 px-6 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl group-hover:scale-105 transform text-center">
                                Pilih Paket
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="block w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-3 px-6 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl group-hover:scale-105 transform text-center">
                                Login untuk Beli
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Tiket Weekend -->
                <div
                    class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-orange-500 to-red-500"></div>
                    <div class="p-8">
                    <div class="text-center mb-6">
                        <div
                                class="w-16 h-16 bg-gradient-to-r from-blue-100 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                        </div>

                        <div class="text-center mb-8">
                            <div class="text-4xl font-bold text-gray-900 mb-2">
                                Rp 35.000
                                <span class="text-lg font-normal text-gray-500">/orang</span>
                            </div>
                            <div class="text-sm text-gray-500">Khusus Hari Sabtu</div>
                        </div>

                        @auth
                            <a href="{{ route('tickets.index') }}"
                                class="block w-full bg-gradient-to-r from-orange-500 to-red-500 text-white py-3 px-6 rounded-xl hover:from-orange-600 hover:to-red-600 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl group-hover:scale-105 transform text-center">
                                Pilih Paket
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="block w-full bg-gradient-to-r from-orange-500 to-red-500 text-white py-3 px-6 rounded-xl hover:from-orange-600 hover:to-red-600 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl group-hover:scale-105 transform text-center">
                                Login untuk Beli
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Tiket Premium -->
                <div
                    class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-gradient-to-r from-purple-500 to-pink-500 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-purple-500 to-pink-500"></div>
                    <div class="p-8">
                    <div class="text-center mb-6">
                        <div
                                class="w-16 h-16 bg-gradient-to-r from-blue-100 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                        </div>

                        <div class="text-center mb-8">
                            <div class="text-4xl font-bold text-gray-900 mb-2">
                                Rp 40.000
                                <span class="text-lg font-normal text-gray-500">/orang</span>
                            </div>
                            <div class="text-sm text-gray-500">Weekend (Minggu dan Hari Libur Nasional)</div>
                        </div>

                        @auth
                            <a href="{{ route('tickets.index') }}"
                                class="block w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-3 px-6 rounded-xl hover:from-orange-600 hover:to-red-600 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl group-hover:scale-105 transform text-center">
                                Pilih Paket
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="block w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-3 px-6 rounded-xl hover:from-orange-600 hover:to-red-600 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl group-hover:scale-105 transform text-center">
                                Login untuk Beli
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kontak" class="py-20 bg-gradient-to-br from-blue-50 to-cyan-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">Kontak Kami</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Punya pertanyaan atau butuh bantuan? Hubungi kami melalui form berikut atau langsung ke kontak resmi.
                    </p>
                    <ul class="space-y-4 text-gray-700">
                        <li><i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>Jl. Poros Maros – Makassar, Sulawesi Selatan</li>
                        <li><i class="fas fa-phone text-blue-500 mr-2"></i>+62 812 3456 7890</li>
                        <li><i class="fas fa-envelope text-blue-500 mr-2"></i>info@grandwaterboom.com</li>
                    </ul>
                </div>

                <div>
                    <form action="#" method="POST" class="bg-white p-8 rounded-2xl shadow-xl space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Nama</label>
                            <input type="text" name="nama" class="w-full mt-2 border rounded-lg p-3 focus:ring focus:ring-blue-200" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Email</label>
                            <input type="email" name="email" class="w-full mt-2 border rounded-lg p-3 focus:ring focus:ring-blue-200" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Pesan</label>
                            <textarea name="pesan" rows="4" class="w-full mt-2 border rounded-lg p-3 focus:ring focus:ring-blue-200" required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-cyan-600 transition-all">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
