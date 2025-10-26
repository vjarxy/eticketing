<nav
    class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                    <img src="{{ asset('images/waterboom.svg') }}" alt="Grand Waterboom">
                </div>
                <span class="text-xl font-bold text-gray-900">Grand Waterboom</span>
            </div>

            <!-- Menu Utama -->
            <div class="hidden md:flex items-center space-x-8">
                @guest
                    <!-- Belum login -->
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Home</a>
                    <a href="#features" class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Fitur</a>
                    <a href="#about" class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Tentang</a>
                    <a href="#wahana" class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Wahana</a>
                    <a href="#galeri" class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Galeri</a>
                    <a href="#tiket" class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Tiket</a>
                    <a href="#kontak" class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Kontak</a>
                @else
                    @if(Auth::user()->role === 'pengunjung')
                        <!-- Menu khusus Pengunjung -->
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Home</a>
                        <a href="{{ route('tickets.index') }}"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Beli Tiket</a>
                        <a href="{{ route('user.etickets.index') }}"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">E-Tiket Saya</a>

                    @elseif(Auth::user()->role === 'petugas')
                        <!-- Menu khusus Petugas -->
                        <a href="{{ route('petugas.dashboard') }}"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Home</a>
                        <a href="{{ route('petugas.transaksi.offline.form') }}"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Pembelian Offline</a>
                        <a href="{{ route('petugas.penjualan.riwayat') }}"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Riwayat Penjualan</a>
                    @endif
                @endguest
            </div>

            <!-- Auth Button -->
            @guest
                <div class="flex items-center space-x-4">
                    <a href="/auth/login"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Masuk</a>
                    <a href="/auth/register"
                        class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 font-medium shadow-lg hover:shadow-xl">Daftar</a>
                </div>
            @else
                @if(Auth::user()->role === 'pengunjung')
                    <!-- Navbar untuk Pengunjung -->
                    <div class="flex items-center space-x-4">
                        <!-- Cart Icon -->
                        <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6 0v6a2 2 0 11-4 0v-6m0 0V9a2 2 0 012-2h2a2 2 0 012 2v4.01" />
                            </svg>
                            @php
                                $cartCount = auth()->user()->carts()->sum('quantity') ?? 0;
                            @endphp
                            @if ($cartCount > 0)
                                <span
                                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>

                        <!-- User Dropdown -->
                        <div class="relative">
                            <button type="button"
                                class="flex items-center text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium"
                                onclick="toggleUserMenu()">
                                <span class="mr-1">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                                </svg>
                            </button>

                            <div id="userMenu"
                                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2">
                                <a href="{{ route('pengunjung.profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile Saya</a>
                                <a href="{{ route('tickets.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Beli Tiket</a>
                                <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Keranjang</a>
                                <a href="{{ route('user.etickets.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">E-Tiket Saya</a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                @elseif(Auth::user()->role === 'petugas')
                    <!-- Navbar untuk Petugas -->
                    <div class="relative">
                        <button type="button"
                            class="flex items-center text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium"
                            onclick="toggleUserMenu()">
                            <span class="mr-1">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                            </svg>
                        </button>

                        <div id="userMenu"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2">
                            <a href="{{ route('petugas.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Dashboard</a>
                            <a href="{{ route('petugas.transaksi.offline.form') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Pembelian Offline</a>
                            <a href="{{ route('petugas.penjualan.riwayat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Riwayat Penjualan</a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
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

<script>
    function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
    }

    // Tutup menu saat klik di luar
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('userMenu');
        const button = event.target.closest('button');
        if (!button || !button.onclick || button.onclick.toString().indexOf('toggleUserMenu') === -1) {
            menu?.classList.add('hidden');
        }
    });
</script>
