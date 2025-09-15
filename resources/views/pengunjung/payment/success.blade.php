<x-app-layout>
    <!-- Success Header -->
    <section class="bg-gradient-to-r from-green-500 to-emerald-500 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-3xl mx-auto">
                <!-- Success Icon -->
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">
                    Pembayaran Berhasil!
                </h1>
                <p class="text-xl text-green-100 mb-6">
                    Terima kasih! E-tiket Anda telah berhasil dibuat dan siap digunakan.
                </p>

                <!-- Transaction Info -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 inline-block">
                    <div class="text-white/90 text-sm mb-2">Nomor Transaksi</div>
                    <div class="text-2xl font-bold text-white">#{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Transaction Details -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Transaction Summary -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-receipt mr-2 text-green-600"></i>
                        Detail Transaksi
                    </h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Nomor Transaksi</span>
                            <span
                                class="font-semibold text-gray-900">#{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Tanggal</span>
                            <span
                                class="font-semibold text-gray-900">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Metode Pembayaran</span>
                            <span class="font-semibold text-gray-900">
                                @if ($transaction->payment_method === 'cash')
                                    <i class="fas fa-money-bill mr-1 text-green-600"></i>Tunai
                                @elseif($transaction->payment_method === 'qris')
                                    <i class="fas fa-qrcode mr-1 text-blue-600"></i>QRIS
                                @else
                                    <i class="fas fa-credit-card mr-1 text-purple-600"></i>Midtrans
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Status</span>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $transaction->status === 'paid' || $transaction->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($transaction->status === 'waiting_payment' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                @if ($transaction->status === 'paid')
                                    <i class="fas fa-check-circle mr-1"></i>Lunas
                                @elseif($transaction->status === 'confirmed')
                                    <i class="fas fa-check-circle mr-1"></i>Terkonfirmasi
                                @elseif($transaction->status === 'waiting_payment')
                                    <i class="fas fa-clock mr-1"></i>Menunggu Pembayaran
                                @else
                                    <i class="fas fa-hourglass-half mr-1"></i>{{ ucfirst($transaction->status) }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Items -->
                    <div class="space-y-3 mb-6">
                        <h3 class="font-semibold text-gray-900">Item yang Dibeli:</h3>
                        @foreach ($transaction->transactionDetails as $detail)
                            <div class="flex justify-between items-center py-2 bg-gray-50 rounded-lg px-4">
                                <div>
                                    <div class="font-medium text-gray-900">{{ $detail->ticket->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $detail->quantity }}x Rp
                                        {{ number_format($detail->price, 0, ',', '.') }}</div>
                                </div>
                                <div class="font-semibold text-gray-900">
                                    Rp {{ number_format($detail->total, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-gray-900">Total Pembayaran</span>
                            <span class="text-2xl font-bold text-green-600">
                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- E-Tickets -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-ticket-alt mr-2 text-blue-600"></i>
                        E-Tiket Anda ({{ $eTickets->count() }} tiket)
                    </h2>

                    <div class="space-y-4 mb-6">
                        @foreach ($eTickets as $index => $eTicket)
                            <div class="border border-gray-200 rounded-xl p-4 hover:border-blue-300 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-semibold text-gray-900">E-Tiket #{{ $index + 1 }}</div>
                                        <div class="text-sm text-gray-600">ID: {{ $eTicket->id }}</div>
                                        <div class="flex items-center mt-2">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                {{ $eTicket->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($eTicket->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{ route('eticket.show', $eTicket) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                        <i class="fas fa-eye mr-1"></i>
                                        Lihat
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Important Notes -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <h4 class="font-semibold text-blue-900 mb-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Penting untuk Diingat:
                        </h4>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• Simpan e-tiket ini dengan baik</li>
                            <li>• Tunjukkan QR code saat masuk waterboom</li>
                            <li>• E-tiket berlaku sesuai tanggal yang dipilih</li>
                            <li>• Hubungi customer service jika ada kendala</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-12 text-center space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
                <a href="{{ route('tickets.index') }}"
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-ticket-alt mr-2"></i>
                    Beli Tiket Lagi
                </a>

                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-8 py-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all duration-200">
                    <i class="fas fa-home mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
