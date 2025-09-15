<x-app-layout>
    <!-- Hero Section -->
    <section id="tiket"
        class="relative min-h-[60vh] flex items-center justify-center bg-gradient-to-br from-blue-600 via-blue-700 to-cyan-600 pt-16 overflow-hidden">
        <!-- Background Animation -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/90 via-blue-700/90 to-cyan-600/90"></div>
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-72 h-72 bg-white/10 rounded-full animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-white/5 rounded-full animate-pulse"></div>
            <div class="absolute top-1/2 left-1/4 w-48 h-48 bg-cyan-300/10 rounded-full animate-bounce"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                Pilih Paket
                <span class="bg-gradient-to-r from-cyan-300 to-blue-300 bg-clip-text text-transparent">
                    Tiket Terbaik
                </span>
            </h1>
            <p class="text-xl sm:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto leading-relaxed">
                Nikmati berbagai wahana seru dengan harga terbaik. Dari tiket reguler hingga paket premium,
                temukan yang sesuai dengan kebutuhan Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <div class="flex items-center text-white/90">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Pembayaran Aman</span>
                </div>
                <div class="flex items-center text-white/90">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>E-Ticket Instant</span>
                </div>
                <div class="flex items-center text-white/90">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Refund Guarantee</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Tickets Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($tickets as $ticket)
                    <div
                        class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden">
                        <!-- Ticket Type Indicator -->
                        <div
                            class="absolute top-0 left-0 right-0 h-2 {{ $ticket->type === 'reguler' ? 'bg-gradient-to-r from-blue-500 to-cyan-500' : ($ticket->type === 'paket' && str_contains(strtolower($ticket->name), 'weekend') ? 'bg-gradient-to-r from-orange-500 to-red-500' : 'bg-gradient-to-r from-purple-500 to-pink-500') }}">
                        </div>

                        <!-- Popular Badge for Premium -->
                        @if (str_contains(strtolower($ticket->name), 'premium'))
                            <div
                                class="absolute top-4 right-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                POPULER
                            </div>
                        @endif

                        <div class="p-8">
                            <!-- Icon and Title -->
                            <div class="text-center mb-6">
                                <div
                                    class="w-16 h-16
                                    {{ $ticket->type === 'reguler' ? 'bg-blue-100' : ($ticket->type === 'paket' && str_contains(strtolower($ticket->name), 'weekend') ? 'bg-orange-100' : 'bg-purple-100') }}
                                    rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8
                                        {{ $ticket->type === 'reguler' ? 'text-blue-600' : ($ticket->type === 'paket' && str_contains(strtolower($ticket->name), 'weekend') ? 'text-orange-600' : 'text-purple-600') }}
                                        fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        @if ($ticket->type === 'reguler')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        @elseif(str_contains(strtolower($ticket->name), 'weekend'))
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        @endif
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $ticket->name }}</h3>
                                <p class="text-gray-600">{{ Str::limit($ticket->description, 80) }}</p>
                            </div>

                            <!-- Price -->
                            <div class="text-center mb-8">
                                <div class="text-4xl font-bold text-gray-900 mb-2">
                                    Rp {{ number_format($ticket->price, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">/orang</span>
                                </div>
                                <div class="text-sm text-gray-500">
                                    @if ($ticket->type === 'reguler')
                                        Weekday (Senin - Jumat)
                                    @elseif(str_contains(strtolower($ticket->name), 'weekend'))
                                        Weekend (Sabtu - Minggu)
                                    @else
                                        Berlaku setiap hari
                                    @endif
                                </div>
                            </div>

                            <!-- Add to Cart Form -->
                            <form action="{{ route('tickets.add-to-cart', $ticket) }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="flex items-center justify-center space-x-3">
                                    <label for="quantity-{{ $ticket->id }}"
                                        class="text-sm font-medium text-gray-700">Jumlah:</label>
                                    <input type="number" id="quantity-{{ $ticket->id }}" name="quantity"
                                        value="1" min="1" max="10"
                                        class="w-16 px-3 py-1 text-center border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <button type="submit"
                                    class="w-full bg-gradient-to-r
                                        {{ $ticket->type === 'reguler' ? 'from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600' : ($ticket->type === 'paket' && str_contains(strtolower($ticket->name), 'weekend') ? 'from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600' : 'from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600') }}
                                        text-white py-3 px-6 rounded-xl transition-all duration-200 font-semibold shadow-lg hover:shadow-xl group-hover:scale-105 transform">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Tambah ke Keranjang
                                </button>
                            </form>

                            <!-- Detail Button -->
                            <a href="{{ route('tickets.show', $ticket) }}"
                                class="block w-full mt-3 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 px-6 rounded-xl transition-all duration-200 font-medium">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="text-6xl text-gray-300 mb-4">🎫</div>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Tiket Tersedia</h3>
                        <p class="text-gray-500">Silakan cek kembali nanti atau hubungi customer service</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
