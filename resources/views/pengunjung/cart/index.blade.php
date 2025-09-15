<x-app-layout>
    <x-navbar />

    <!-- Header -->
    <section class="bg-gradient-to-r from-blue-600 to-cyan-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">
                <i class="fas fa-shopping-cart mr-3"></i>
                Keranjang Belanja
            </h1>
            <p class="text-xl text-blue-100">
                Review dan kelola tiket pilihan Anda
            </p>
        </div>
    </section>

    <!-- Cart Content -->
    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($cartItems->count() > 0)
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-6">
                        @foreach ($cartItems as $item)
                            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                                <div class="flex items-center justify-between">
                                    <!-- Ticket Info -->
                                    <div class="flex items-start space-x-4 flex-1">
                                        <div
                                            class="w-16 h-16 rounded-xl flex items-center justify-center
                                            {{ $item->ticket->type === 'reguler'
                                                ? 'bg-gradient-to-r from-blue-100 to-cyan-100'
                                                : ($item->ticket->type === 'paket' && str_contains(strtolower($item->ticket->name), 'weekend')
                                                    ? 'bg-gradient-to-r from-orange-100 to-red-100'
                                                    : 'bg-gradient-to-r from-purple-100 to-pink-100') }}">
                                            <svg class="w-8 h-8 {{ $item->ticket->type === 'reguler'
                                                ? 'text-blue-600'
                                                : ($item->ticket->type === 'paket' && str_contains(strtolower($item->ticket->name), 'weekend')
                                                    ? 'text-orange-600'
                                                    : 'text-purple-600') }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                                {{ $item->ticket->name }}</h3>
                                            <p class="text-gray-600 text-sm mb-2">
                                                {{ Str::limit($item->ticket->description, 100) }}</p>
                                            <div class="flex items-center space-x-2">
                                                <span
                                                    class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                                    {{ $item->ticket->type === 'reguler'
                                                        ? 'bg-blue-100 text-blue-800'
                                                        : ($item->ticket->type === 'paket' && str_contains(strtolower($item->ticket->name), 'weekend')
                                                            ? 'bg-orange-100 text-orange-800'
                                                            : 'bg-purple-100 text-purple-800') }}">
                                                    {{ ucfirst($item->ticket->type) }}
                                                </span>
                                                <span class="text-lg font-bold text-gray-900">
                                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center space-x-4">
                                        <form action="{{ route('cart.update', $item) }}" method="POST"
                                            class="flex items-center space-x-2">
                                            @csrf
                                            @method('PATCH')
                                            <div class="flex items-center space-x-2 border border-gray-300 rounded-lg">
                                                <button type="button" onclick="decreaseQuantity({{ $item->id }})"
                                                    class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-l-lg flex items-center justify-center">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M20 12H4"></path>
                                                    </svg>
                                                </button>
                                                <input type="number" id="quantity-{{ $item->id }}" name="quantity"
                                                    value="{{ $item->quantity }}" min="1" max="10"
                                                    class="w-16 px-2 py-2 text-center border-0 focus:outline-none focus:ring-0"
                                                    onchange="this.form.submit()">
                                                <button type="button" onclick="increaseQuantity({{ $item->id }})"
                                                    class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-r-lg flex items-center justify-center">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>

                                        <!-- Total & Remove -->
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-gray-900 mb-1">
                                                Rp {{ number_format($item->total, 0, ',', '.') }}
                                            </div>
                                            <form action="{{ route('cart.destroy', $item) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Hapus item dari keranjang?')"
                                                    class="text-red-500 hover:text-red-700 text-sm font-medium">
                                                    <i class="fas fa-trash mr-1"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Continue Shopping -->
                        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                            <div class="text-center">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Ingin menambah tiket lain?</h3>
                                <p class="text-gray-600 mb-4">Jelajahi koleksi tiket kami yang beragam</p>
                                <a href="{{ route('tickets.index') }}"
                                    class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-all duration-200">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Lanjut Belanja
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 sticky top-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Ringkasan Pesanan</h3>

                            <!-- Items Summary -->
                            <div class="space-y-3 mb-6">
                                @foreach ($cartItems as $item)
                                    <div class="flex justify-between items-center">
                                        <div class="flex-1">
                                            <span class="text-sm text-gray-600">{{ $item->ticket->name }}</span>
                                            <span class="text-xs text-gray-500 block">{{ $item->quantity }}x Rp
                                                {{ number_format($item->price, 0, ',', '.') }}</span>
                                        </div>
                                        <span class="font-medium text-gray-900">
                                            Rp {{ number_format($item->total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-200 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-2xl font-bold text-gray-900">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <a href="{{ route('payment.checkout') }}"
                                    class="block w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white py-4 px-6 rounded-xl transition-all duration-200 font-semibold shadow-lg hover:shadow-xl text-center">
                                    <i class="fas fa-credit-card mr-2"></i>
                                    Checkout
                                </a>

                                <form action="{{ route('cart.clear') }}" method="POST" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Kosongkan seluruh keranjang?')"
                                        class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-6 rounded-xl transition-all duration-200 font-medium">
                                        <i class="fas fa-trash mr-2"></i>
                                        Kosongkan Keranjang
                                    </button>
                                </form>
                            </div>

                            <!-- Security Badge -->
                            <div class="mt-6 p-4 bg-green-50 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span class="text-sm text-green-700 font-medium">
                                        Pembayaran 100% Aman
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6 0v6a2 2 0 11-4 0v-6m0 0V9a2 2 0 012-2h2a2 2 0 012 2v4.01" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Keranjang Masih Kosong</h2>
                        <p class="text-gray-600 mb-8">
                            Belum ada tiket yang dipilih. Mulai jelajahi dan pilih tiket terbaik untuk pengalaman
                            waterboom yang tak terlupakan!
                        </p>
                        <a href="{{ route('tickets.index') }}"
                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="fas fa-ticket-alt mr-2"></i>
                            Mulai Belanja Tiket
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <script>
        function increaseQuantity(itemId) {
            const quantityInput = document.getElementById('quantity-' + itemId);
            if (quantityInput.value < 10) {
                quantityInput.value = parseInt(quantityInput.value) + 1;
                quantityInput.form.submit();
            }
        }

        function decreaseQuantity(itemId) {
            const quantityInput = document.getElementById('quantity-' + itemId);
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                quantityInput.form.submit();
            }
        }
    </script>

    <x-footer />
</x-app-layout>
