<x-app-layout>
    <x-slot name="title">Dashboard Petugas - Riwayat Penjualan</x-slot>
    <x-slot name="description">Melihat riwayat penjualan tiket pengunjung</x-slot>

    <section class="bg-gradient-to-r from-blue-600 to-blue-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">
                <i class="fas fa-history mr-3"></i>Riwayat Penjualan
            </h1>
            <p class="text-xl text-blue-100">
                Daftar transaksi tiket pengunjung yang sudah dibayar, terkonfirmasi, atau hangus
            </p>
        </div>
    </section>

    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Filter Status -->
            <div class="flex justify-between items-center mb-6">
                <form method="GET" class="flex items-center gap-2">
                    <select name="status" class="border border-gray-300 rounded-lg px-3 py-2">
                        <option value="">Semua Status</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Dibayar</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Terkonfirmasi</option>
                        <option value="cancel" {{ request('status') == 'cancel' ? 'selected' : '' }}>Hangus</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-filter mr-1"></i>Filter
                    </button>
                </form>

                <a href="{{ route('petugas.riwayatPenjualan') }}" 
                   class="text-blue-600 hover:underline text-sm">Reset Filter</a>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-list mr-2 text-blue-600"></i>Daftar Transaksi Terbaru
                </h2>

                <form method="GET" action="{{ route('petugas.riwayatPenjualan') }}" class="mb-4 flex justify-end">
                    <select name="status" onchange="this.form.submit()" class="border-gray-300 rounded-lg p-2 text-sm">
                        <option value="">Semua Status</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Sudah Dibayar</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Terkonfirmasi</option>
                        <option value="hangus" {{ request('status') == 'hangus' ? 'selected' : '' }}>Hangus</option>
                    </select>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiket</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status E-Ticket</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($transactions as $index => $transaction)
                                <tr>
                                    <td class="px-4 py-2">{{ $transactions->firstItem() + $index }}</td>
                                    <td class="px-4 py-2">{{ $transaction->user->name }}</td>
                                    <td class="px-4 py-2">
                                        {{ $transaction->transactionDetails->pluck('ticket.name')->join(', ') }}
                                    </td>
                                    <td class="px-4 py-2">{{ $transaction->transactionDetails->sum('quantity') }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($transaction->total,0,',','.') }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($transaction->payment_method) }}</td>

                                    <!-- Warna status -->
                                    <td class="px-4 py-2">
                                        @php
                                            $displayStatus = $transaction->status === 'cancel' ? 'Hangus' : ucfirst($transaction->status);
                                            $color = match($transaction->status) {
                                                'paid' => 'bg-yellow-100 text-yellow-700',
                                                'confirmed' => 'bg-green-100 text-green-700',
                                                'cancel' => 'bg-red-100 text-red-700',
                                                default => 'bg-gray-100 text-gray-700'
                                            };
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                            {{ $displayStatus }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-2">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-2">
                                        {{ $transaction->eTickets->pluck('status')->join(', ') }}
                                    </td>
                                    <td class="px-4 py-2">
                                        @if($transaction->status !== 'cancel')
                                            <button 
                                                onclick="printTicket('{{ $transaction->id }}', '{{ $transaction->user->name }}', '{{ $transaction->created_at->format('d/m/Y H:i') }}', '{{ $transaction->eTickets->first()->qr_code ?? '' }}')"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                                                <i class="fas fa-print mr-2"></i> Print
                                            </button>
                                        @else
                                            <span class="text-gray-400 text-sm italic">Tidak dapat dicetak</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </section>

    <script>
        function printTicket(transactionId, userName, purchaseDate, qrCodeData) {
            const htmlContent = `
                <html>
                <head>
                    <title>E-Ticket #${transactionId}</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; text-align: center; }
                        .ticket { border: 2px dashed #1e3a8a; border-radius: 10px; padding: 25px; width: 350px; margin: 0 auto; }
                        h2 { color: #1e3a8a; margin-bottom: 20px; }
                        .qr { margin: 15px 0; }
                        .info { text-align: left; margin-top: 10px; font-size: 14px; }
                        .footer { margin-top: 20px; font-size: 12px; color: gray; }
                    </style>
                </head>
                <body>
                    <div class="ticket">
                        <div class="qr">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(qrCodeData || 'No QR Code')}" alt="QR Code">
                        </div>
                        <div class="info">
                            <p><strong>Nomor Transaksi:</strong> ${transactionId}</p>
                            <p><strong>Pemegang Tiket:</strong> ${userName}</p>
                            <p><strong>Tanggal Pembelian:</strong> ${purchaseDate}</p>
                        </div>
                        <div class="footer">
                            <p>Harap tunjukkan tiket ini di pintu masuk.</p>
                        </div>
                    </div>
                    <script>
                        window.onload = () => { window.print(); setTimeout(() => window.close(), 500); }
                    <\/script>
                </body>
                </html>
            `;
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(htmlContent);
            printWindow.document.close();
        }
    </script>
</x-app-layout>