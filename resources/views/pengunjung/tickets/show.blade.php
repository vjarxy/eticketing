<x-app-layout>
    <!-- Breadcrumb -->
    <section class="bg-gray-50 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-3 h-3 mr-2.5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7">
                                </path>
                            </svg>
                            <a href="{{ route('tickets.index') }}"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Tiket</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7">
                                </path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $ticket->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Ticket Detail -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-start">
                <!-- Ticket Info -->
                <div>
                    <div class="mb-6">
                        <div
                            class="inline-block px-3 py-1 text-sm font-semibold rounded-full mb-4
                            {{ $ticket->type === 'reguler' ? 'bg-blue-100 text-blue-800' : ($ticket->type === 'paket' && str_contains(strtolower($ticket->name), 'weekend') ? 'bg-orange-100 text-orange-800' : 'bg-purple-100 text-purple-800') }}">
                            {{ ucfirst($ticket->type) }}
                        </div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $ticket->name }}</h1>
                        <div class="flex items-center space-x-4">
                            <div class="text-3xl font-bold text-gray-900">
                                Rp {{ number_format($ticket->price, 0, ',', '.') }}
                            </div>
                            <div class="text-lg text-gray-500">/orang</div>
                        </div>
                    </div>

                    <div class="prose prose-gray max-w-none mb-8">
                        <p class="text-lg text-gray-700 leading-relaxed">{{ $ticket->description }}</p>
                    </div>

                    <!-- Features -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Fasilitas Termasuk:</h3>
                        <ul class="space-y-3">
                            @if ($ticket->type === 'reguler')
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Akses semua wahana air</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Fasilitas locker</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Area parkir gratis</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Berlaku seharian</span>
                                </li>
                            @elseif(str_contains(strtolower($ticket->name), 'weekend'))
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Semua fasilitas reguler</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Akses wahana premium</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Welcome drink gratis</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Event & hiburan spesial</span>
                                </li>
                            @else
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Semua fasilitas premium</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Private locker VIP</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Free lunch & snack</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Priority access semua wahana</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Photo session gratis</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Purchase Form -->
                <div class="lg:sticky lg:top-8">
                    <div class="bg-white border-2 border-gray-200 rounded-2xl p-8 shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Beli Tiket</h3>

                        <form action="{{ route('tickets.add-to-cart', $ticket) }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Quantity -->
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                    Jumlah Tiket
                                </label>
                                <div class="flex items-center space-x-3">
                                    <button type="button" onclick="decreaseQuantity()"
                                        class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <input type="number" id="quantity" name="quantity" value="1"
                                        min="1" max="10"
                                        class="w-20 px-3 py-2 text-center border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <button type="button" onclick="increaseQuantity()"
                                        class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Price Summary -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-center text-lg">
                                    <span class="font-medium text-gray-700">Total Harga:</span>
                                    <span class="font-bold text-gray-900" id="total-price">
                                        Rp {{ number_format($ticket->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Add to Cart Button -->
                            <button type="submit"
                                class="w-full bg-gradient-to-r
                                    {{ $ticket->type === 'reguler' ? 'from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600' : ($ticket->type === 'paket' && str_contains(strtolower($ticket->name), 'weekend') ? 'from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600' : 'from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600') }}
                                    text-white py-4 px-6 rounded-xl transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Tambah ke Keranjang
                            </button>

                            <a href="{{ route('tickets.index') }}"
                                class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-6 rounded-xl transition-all duration-200 font-medium">
                                Kembali ke Daftar Tiket
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const pricePerTicket = {{ $ticket->price }};

        function updateTotalPrice() {
            const quantity = document.getElementById('quantity').value;
            const total = pricePerTicket * quantity;
            document.getElementById('total-price').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        function increaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            if (quantityInput.value < 10) {
                quantityInput.value = parseInt(quantityInput.value) + 1;
                updateTotalPrice();
            }
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updateTotalPrice();
            }
        }

        document.getElementById('quantity').addEventListener('input', updateTotalPrice);
    </script>
</x-app-layout>
