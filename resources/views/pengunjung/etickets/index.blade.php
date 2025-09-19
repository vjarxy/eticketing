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
                <!-- Filter Tabs -->
                <div class="mb-8">
                    <div class="flex space-x-1 bg-gray-100 p-1 rounded-xl max-w-md">
                        <button onclick="filterTransactions('all')"
                            class="filter-btn flex-1 px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 bg-white text-gray-900 shadow-sm"
                            data-filter="all">
                            <i class="fas fa-list mr-1"></i>
                            Semua ({{ $transactions->count() }})
                        </button>
                        <button onclick="filterTransactions('pending')"
                            class="filter-btn flex-1 px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 text-gray-600 hover:text-gray-900"
                            data-filter="pending">
                            <i class="fas fa-hourglass-half mr-1"></i>
                            Menunggu ({{ $transactions->where('status', 'pending')->count() }})
                        </button>
                        <button onclick="filterTransactions('paid')"
                            class="filter-btn flex-1 px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 text-gray-600 hover:text-gray-900"
                            data-filter="paid">
                            <i class="fas fa-check-circle mr-1"></i>
                            Lunas ({{ $transactions->whereIn('status', ['paid', 'confirmed'])->count() }})
                        </button>
                    </div>
                </div>

                <!-- Transactions List -->
                <div class="space-y-6">
                    @foreach ($transactions as $transaction)
                        <div class="transaction-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden"
                            data-status="{{ $transaction->status }}" data-payment="{{ $transaction->payment_method }}">
                            <!-- Transaction Header -->
                            <div
                                class="bg-gradient-to-r
                                {{ $transaction->status === 'pending' ? 'from-orange-500 to-yellow-500' : 'from-green-500 to-teal-500' }}
                                px-6 py-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="text-white">
                                        <h3 class="text-lg font-semibold">
                                            Transaksi #{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}
                                        </h3>
                                        <p
                                            class="{{ $transaction->status === 'pending' ? 'text-orange-100' : 'text-green-100' }} text-sm">
                                            {{ $transaction->created_at->format('d F Y, H:i') }} WIB
                                        </p>
                                    </div>
                                    <div class="mt-2 sm:mt-0">
                                        @if ($transaction->status === 'pending' && $transaction->payment_method === 'cash')
                                            <span
                                                class="bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">
                                                <i class="fas fa-money-bill mr-1"></i>
                                                Menunggu Pembayaran Tunai
                                            </span>
                                        @elseif($transaction->status === 'paid')
                                            <span
                                                class="bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Sudah Dibayar
                                            </span>
                                        @endif
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
                                            Detail Pembayaran
                                        </h4>
                                        <div class="bg-green-50 rounded-lg p-4 border border-green-200 space-y-2">
                                            <div class="text-3xl font-bold text-green-600">
                                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                            </div>
                                            <div class="text-sm text-green-700">
                                                Total {{ $transaction->eTickets->count() }} E-Tiket
                                            </div>
                                            <div
                                                class="flex items-center justify-between pt-2 border-t border-green-200">
                                                <span class="text-sm text-green-700">Metode:</span>
                                                <span class="font-medium">
                                                    @if ($transaction->payment_method === 'cash')
                                                        <i class="fas fa-money-bill text-green-600 mr-1"></i>Tunai
                                                    @else
                                                        <i class="fas fa-credit-card text-purple-600 mr-1"></i>Midtrans
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-green-700">Status:</span>
                                                <span class="text-sm font-medium">
                                                    @if ($transaction->status === 'pending')
                                                        <span class="text-orange-600">
                                                            <i class="fas fa-hourglass-half mr-1"></i>Menunggu
                                                            Pembayaran
                                                        </span>
                                                    @elseif($transaction->status === 'paid')
                                                        <span class="text-green-600">
                                                            <i class="fas fa-check-circle mr-1"></i>Lunas
                                                        </span>
                                                    @elseif($transaction->status === 'confirmed')
                                                        <span class="text-blue-600">
                                                            <i class="fas fa-check-double mr-1"></i>Terkonfirmasi
                                                        </span>
                                                    @else
                                                        <span class="text-gray-600">
                                                            <i
                                                                class="fas fa-times-circle mr-1"></i>{{ ucfirst($transaction->status) }}
                                                        </span>
                                                    @endif
                                                </span>
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
                                                        class="{{ $eTicket->status == 'active' ? 'bg-green-100 text-green-800' : ($eTicket->status == 'used' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800') }}
                                                        px-2 py-1 rounded-full text-xs font-semibold">
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

    <!-- Filter JavaScript -->
    <script>
        function filterTransactions(filter) {
            const cards = document.querySelectorAll('.transaction-card');
            const buttons = document.querySelectorAll('.filter-btn');

            // Update button styles
            buttons.forEach(btn => {
                if (btn.dataset.filter === filter) {
                    btn.classList.remove('text-gray-600', 'hover:text-gray-900');
                    btn.classList.add('bg-white', 'text-gray-900', 'shadow-sm');
                } else {
                    btn.classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
                    btn.classList.add('text-gray-600', 'hover:text-gray-900');
                }
            });

            // Filter cards
            cards.forEach(card => {
                const status = card.dataset.status;
                let show = false;

                switch (filter) {
                    case 'all':
                        show = true;
                        break;
                    case 'pending':
                        show = status === 'pending';
                        break;
                    case 'paid':
                        show = status === 'paid' || status === 'confirmed';
                        break;
                }

                if (show) {
                    card.style.display = 'block';
                    // Add fade in animation
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(10px)';
                    setTimeout(() => {
                        card.style.transition = 'all 0.3s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide empty state message if needed
            const visibleCards = Array.from(cards).filter(card => card.style.display !== 'none');
            const emptyMessage = document.getElementById('filter-empty-message');

            if (visibleCards.length === 0 && !emptyMessage) {
                // Create empty message
                const container = cards[0]?.parentElement;
                if (container) {
                    const emptyDiv = document.createElement('div');
                    emptyDiv.id = 'filter-empty-message';
                    emptyDiv.className = 'text-center py-12';
                    emptyDiv.innerHTML = `
                        <div class="bg-white rounded-2xl shadow-lg p-8 max-w-md mx-auto">
                            <div class="text-4xl mb-4">🔍</div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Transaksi</h3>
                            <p class="text-gray-600 text-sm">Tidak ada transaksi yang sesuai dengan filter yang dipilih.</p>
                        </div>
                    `;
                    container.appendChild(emptyDiv);
                }
            } else if (visibleCards.length > 0 && emptyMessage) {
                emptyMessage.remove();
            }
        }

        // Auto highlight pending transactions on load
        document.addEventListener('DOMContentLoaded', function() {
            const pendingCards = document.querySelectorAll('.transaction-card[data-status="pending"]');
            pendingCards.forEach(card => {
                // Add subtle glow animation for pending transactions
                card.style.boxShadow = '0 0 0 2px rgba(251, 146, 60, 0.2)';

                // Add pulse animation
                const pulseKeyframes = `
                    @keyframes pendingPulse {
                        0%, 100% { box-shadow: 0 0 0 2px rgba(251, 146, 60, 0.2); }
                        50% { box-shadow: 0 0 0 4px rgba(251, 146, 60, 0.1); }
                    }
                `;

                if (!document.getElementById('pending-pulse-style')) {
                    const style = document.createElement('style');
                    style.id = 'pending-pulse-style';
                    style.textContent = pulseKeyframes;
                    document.head.appendChild(style);
                }

                card.style.animation = 'pendingPulse 2s infinite';
            });
        });
    </script>
</x-app-layout>
