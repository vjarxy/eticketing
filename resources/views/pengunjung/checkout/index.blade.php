{{-- @if (session('snapToken'))
    {{ dd(session('snapToken')) }}
@endif --}}

<x-app-layout>
    <!-- Checkout Content -->
    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Error/Success Messages -->
            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                    <strong>Success:</strong> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                    <strong>Validation Errors:</strong>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('payment.process') }}" method="POST">
                @csrf

                <input type="hidden" name="total" id="total" value="{{ $total }}">
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Payment Methods -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                <i class="fas fa-payment mr-2 text-blue-600"></i>
                                Pilih Metode Pembayaran
                            </h2>

                            <div class="space-y-4">
                                @foreach ($paymentMethods as $method)
                                    <label class="block">
                                        <input type="radio" name="payment_method" value="{{ $method->code }}"
                                            class="sr-only peer" @if ($loop->first) checked @endif>
                                        <div
                                            class="relative p-6 border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-4">
                                                    <!-- Payment Method Icon -->
                                                    <div
                                                        class="w-16 h-16 rounded-xl flex items-center justify-center
                                                        {{ $method->code === 'cash' ? 'bg-green-100' : 'bg-purple-100' }}">
                                                        @if ($method->code === 'cash')
                                                            <svg class="w-8 h-8 text-green-600" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                                            </svg>
                                                        @else
                                                            <svg class="w-8 h-8 text-purple-600" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                            </svg>
                                                        @endif
                                                    </div>

                                                    <div>
                                                        <h3 class="text-lg font-semibold text-gray-900">
                                                            {{ $method->name }}</h3>
                                                        <p class="text-gray-600">{{ $method->description }}</p>

                                                        @if ($method->code === 'cash')
                                                            <div class="flex items-center mt-2">
                                                                <svg class="w-4 h-4 text-green-500 mr-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                                <span class="text-sm text-green-600 font-medium">Bayar
                                                                    di tempat</span>
                                                            </div>
                                                        @else
                                                            <div class="flex items-center mt-2">
                                                                <svg class="w-4 h-4 text-purple-500 mr-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                                                    </path>
                                                                </svg>
                                                                <span class="text-sm text-purple-600 font-medium">Aman &
                                                                    terpercaya</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Check Mark -->
                                                <div
                                                    class="absolute top-4 right-4 w-6 h-6 bg-blue-500 rounded-full items-center justify-center hidden peer-checked:flex">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            </div>

                                            <!-- Additional Info -->
                                            @if ($method->code === 'cash')
                                                <div class="mt-4 p-4 bg-green-50 rounded-lg border border-green-200">
                                                    <div class="flex items-start">
                                                        <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                        <div class="text-sm text-green-700">
                                                            <p class="font-medium mb-1">Pembayaran Tunai</p>
                                                            <p>E-tiket akan langsung tersedia setelah konfirmasi.
                                                                Lakukan pembayaran di lokasi waterboom.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="mt-4 p-4 bg-purple-50 rounded-lg border border-purple-200">
                                                    <div class="flex items-start">
                                                        <svg class="w-5 h-5 text-purple-500 mt-0.5 mr-2" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                        <div class="text-sm text-purple-700">
                                                            <p class="font-medium mb-1">Gateway Midtrans</p>
                                                            <p>Bayar dengan kartu kredit, debit, atau berbagai metode
                                                                pembayaran lainnya melalui Midtrans yang aman.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Back to Cart -->
                        <div class="mt-6">
                            <a href="{{ route('cart.index') }}"
                                class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Kembali ke Keranjang
                            </a>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 sticky top-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">
                                <i class="fas fa-receipt mr-2 text-green-600"></i>
                                Ringkasan Pesanan
                            </h3>

                            <!-- Items -->
                            <div class="space-y-4 mb-6">
                                @foreach ($cartItems as $item)
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-12 h-12
                                            {{ $item->ticket->type === 'reguler' ? 'bg-blue-100' : ($item->ticket->type === 'paket' && str_contains(strtolower($item->ticket->name), 'weekend') ? 'bg-orange-100' : 'bg-purple-100') }}
                                            rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6
                                                {{ $item->ticket->type === 'reguler' ? 'text-blue-600' : ($item->ticket->type === 'paket' && str_contains(strtolower($item->ticket->name), 'weekend') ? 'text-orange-600' : 'text-purple-600') }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900 text-sm">{{ $item->ticket->name }}
                                            </h4>
                                            <p class="text-xs text-gray-500">{{ $item->quantity }}x Rp
                                                {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="font-medium text-gray-900 text-sm">
                                                Rp {{ number_format($item->total, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Total -->
                            <div class="border-t border-gray-200 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-900">Total Pembayaran</span>
                                    <span class="text-2xl font-bold text-gray-900">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Process Payment Button -->
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white py-4 px-6 rounded-xl transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                                <i class="fas fa-lock mr-2"></i>
                                Proses Pembayaran
                            </button>

                            <!-- Security Info -->
                            <div class="mt-6 space-y-3">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                    <span>Pembayaran 256-bit SSL encrypted</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                    <span>E-tiket dikirim instant</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                    <span>Garansi refund 100%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>

    <script>
        // Debug form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form is being submitted');
            console.log('Action:', this.action);
            console.log('Method:', this.method);

            const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            console.log('Selected payment method:', paymentMethod ? paymentMethod.value : 'None');

            // Show loading state
            const submitBtn = document.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            submitBtn.disabled = true;
        });
    </script>

    @if (session('snapToken'))
        <script>
            snap.pay("{{ session('snapToken') }}", {
                onSuccess: function(result) {
                    window.location = "{{ route('payment.success', session('transactionId')) }}";
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran...");
                },
                onError: function(result) {
                    alert("Pembayaran gagal");
                }
            });
        </script>
    @endif
</x-app-layout>
