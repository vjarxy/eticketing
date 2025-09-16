<x-app-layout>
    <x-navbar />

    <!-- Header -->
    <section class="bg-gradient-to-r from-green-600 to-teal-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">
                <i class="fas fa-ticket-alt mr-3"></i>
                E-Tiket Saya
            </h1>
            <p class="text-xl text-green-100">
                Kelola dan lihat semua e-tiket yang telah Anda beli
            </p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                    <strong>Success:</strong> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif

            @if ($transactions->count() > 0)
                <!-- Transactions List -->
                <div class="space-y-6">
                    @foreach ($transactions as $transaction)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                            <!-- Transaction Header -->
                            <div class="bg-gradient-to-r from-green-500 to-teal-500 px-6 py-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="text-white">
                                        <h3 class="text-lg font-semibold">
                                            Transaksi #{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}
                                        </h3>
                                        <p class="text-green-100 text-sm">
                                            {{ $transaction->created_at->format('d F Y, H:i') }} WIB
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <!-- Transaction Summary -->
                                <div class="grid md:grid-cols-2 gap-6 mb-6">
                                    <!-- Purchased Items -->
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900 mb-3">
                                            <i class="fas fa-list mr-2 text-blue-600"></i>
                                            Item yang Dibeli
                                        </h4>
                                        <div class="space-y-2">
                                            @foreach ($transaction->transactionDetails as $detail)
                                                <div
                                                    class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                                                    <div>
                                                        <span
                                                            class="font-medium text-gray-900">{{ $detail->ticket->name }}</span>
                                                        <span
                                                            class="text-gray-600 text-sm ml-2">({{ $detail->quantity }}x)</span>
                                                    </div>
                                                    <span class="font-medium text-gray-900">
                                                        Rp {{ number_format($detail->total, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Total -->
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900 mb-3">
                                            <i class="fas fa-calculator mr-2 text-green-600"></i>
                                            Total Pembayaran
                                        </h4>
                                        <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                                            <div class="text-3xl font-bold text-green-600">
                                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                            </div>
                                            <div class="text-sm text-green-700 mt-1">
                                                Total {{ $transaction->eTickets->count() }} E-Tiket
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- E-Tickets -->
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">
                                        <i class="fas fa-qrcode mr-2 text-purple-600"></i>
                                        E-Tiket ({{ $transaction->eTickets->count() }})
                                    </h4>

                                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach ($transaction->eTickets as $index => $eTicket)
                                            @php
                                                $ticketData = json_decode($eTicket->qr_code, true);
                                            @endphp

                                            <div
                                                class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow duration-200">
                                                <!-- E-Ticket Header -->
                                                <div class="flex justify-between items-start mb-3">
                                                    <div>
                                                        <h5 class="font-semibold text-gray-900 text-sm">
                                                            {{ $ticketData['ticket_name'] ?? 'E-Tiket' }}
                                                        </h5>
                                                        <p class="text-xs text-gray-600">
                                                            Tiket #{{ $index + 1 }}
                                                        </p>
                                                    </div>
                                                    <span
                                                        class="
                                                        @if ($eTicket->status == 'valid') bg-green-100 text-green-800
                                                        @elseif($eTicket->status == 'used') bg-gray-100 text-gray-800
                                                        @else bg-red-100 text-red-800 @endif
                                                        px-2 py-1 rounded-full text-xs font-semibold
                                                    ">
                                                        {{ strtoupper($eTicket->status) }}
                                                    </span>
                                                </div>

                                                <!-- Mini QR Code -->
                                                <div class="text-center mb-3">
                                                    <div
                                                        class="inline-block p-2 bg-white border border-gray-200 rounded-lg">
                                                        {!! QrCode::size(80)->backgroundColor(255, 255, 255)->color(0, 0, 0)->margin(0)->generate($eTicket->qr_code) !!}
                                                    </div>
                                                </div>

                                                <!-- Verification Code -->
                                                <div class="text-center mb-3">
                                                    <div class="text-xs text-gray-600 mb-1">Kode Verifikasi:</div>
                                                    <div
                                                        class="font-mono text-xs font-bold text-purple-600 bg-purple-50 px-2 py-1 rounded">
                                                        {{ $ticketData['verification_code'] ?? 'N/A' }}
                                                    </div>
                                                </div>

                                                <!-- Actions -->
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('user.etickets.show', $eTicket) }}"
                                                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-2 px-3 rounded-lg text-center transition-colors duration-200">
                                                        <i class="fas fa-eye mr-1"></i>
                                                        Lihat Detail
                                                    </a>
                                                    <a href="{{ route('user.etickets.download', $eTicket) }}"
                                                        class="flex-1 bg-green-500 hover:bg-green-600 text-white text-xs font-medium py-2 px-3 rounded-lg text-center transition-colors duration-200">
                                                        <i class="fas fa-download mr-1"></i>
                                                        Download
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination would go here if needed -->
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="bg-white rounded-2xl shadow-lg p-12 max-w-2xl mx-auto">
                        <div class="text-6xl mb-6">🎫</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada E-Tiket</h3>
                        <p class="text-gray-600 mb-8">
                            Anda belum memiliki e-tiket. Mulai jelajahi koleksi tiket kami dan beli tiket pertama Anda!
                        </p>
                        <a href="{{ route('tickets.index') }}"
                            class="inline-flex items-center bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Lihat Tiket Tersedia
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <x-footer />
</x-app-layout>
