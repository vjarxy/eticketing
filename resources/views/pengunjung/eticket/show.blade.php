<x-app-layout>
    <x-navbar />

    <!-- Header -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">
                <i class="fas fa-ticket-alt mr-3"></i>
                E-Tiket Digital
            </h1>
            <p class="text-xl text-blue-100">
                Tunjukkan tiket ini saat masuk waterboom
            </p>
        </div>
    </section>

    <!-- E-Ticket Content -->
    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- E-Ticket Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                <!-- Ticket Header -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h1 class="text-2xl font-bold">Grand Waterboom Maros</h1>
                            <p class="text-blue-100">E-Tiket Digital</p>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-blue-100">ID Tiket</div>
                            <div class="text-xl font-bold">#{{ str_pad($eTicket->id, 6, '0', STR_PAD_LEFT) }}</div>
                        </div>
                    </div>
                </div>

                <!-- Ticket Body -->
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- QR Code Section -->
                        <div class="text-center">
                            <div class="bg-white border-4 border-gray-200 rounded-2xl p-6 inline-block shadow-lg">
                                {!! $qrCode !!}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mt-4 mb-2">Scan QR Code</h3>
                            <p class="text-gray-600 text-sm">
                                Tunjukkan QR code ini ke petugas untuk masuk
                            </p>

                            <!-- Status Badge -->
                            <div class="mt-4">
                                <span
                                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                                    {{ $eTicket->status === 'active' ? 'bg-green-100 text-green-800' : ($eTicket->status === 'used' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800') }}">
                                    @if ($eTicket->status === 'active')
                                        <i class="fas fa-check-circle mr-1"></i>Aktif
                                    @elseif($eTicket->status === 'used')
                                        <i class="fas fa-times-circle mr-1"></i>Sudah Digunakan
                                    @else
                                        <i class="fas fa-ban mr-1"></i>Tidak Aktif
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Ticket Details -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Detail Tiket</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Nomor Transaksi</span>
                                        <span
                                            class="font-semibold text-gray-900">#{{ str_pad($eTicket->transaction->id, 6, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                    @if (isset($ticketDetails['verification_code']))
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-gray-600">Kode Verifikasi</span>
                                            <span
                                                class="font-semibold text-purple-600 font-mono">{{ $ticketDetails['verification_code'] }}</span>
                                        </div>
                                    @endif
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Pemegang Tiket</span>
                                        <span
                                            class="font-semibold text-gray-900">{{ $eTicket->transaction->user->name }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Tanggal Pembelian</span>
                                        <span
                                            class="font-semibold text-gray-900">{{ $eTicket->transaction->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    @if (isset($ticketDetails['ticket_name']))
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-gray-600">Jenis Tiket</span>
                                            <span
                                                class="font-semibold text-blue-600">{{ $ticketDetails['ticket_name'] }}</span>
                                        </div>
                                    @endif
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Total Pembayaran</span>
                                        <span class="font-semibold text-green-600">Rp
                                            {{ number_format($eTicket->transaction->total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Ticket Items -->
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-3">Paket Tiket:</h4>
                                <div class="space-y-2">
                                    @foreach ($eTicket->transaction->transactionDetails as $detail)
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <div class="font-medium text-gray-900">{{ $detail->ticket->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-600">{{ $detail->quantity }}x tiket
                                                    </div>
                                                </div>
                                                <div class="text-sm">
                                                    <span
                                                        class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                                        {{ ucfirst($detail->ticket->type) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Important Information -->
                    <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                        <h4 class="font-semibold text-yellow-900 mb-3">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Informasi Penting:
                        </h4>
                        <div class="grid md:grid-cols-2 gap-4 text-sm text-yellow-800">
                            <ul class="space-y-1">
                                <li>• Tiket berlaku untuk 1 orang</li>
                                <li>• Tidak dapat direfund setelah digunakan</li>
                                <li>• Tunjukkan QR code kepada petugas</li>
                                <li>• Simpan e-tiket hingga selesai berkunjung</li>
                            </ul>
                            <ul class="space-y-1">
                                <li>• Jam operasional: 08.00 - 17.00 WIB</li>
                                <li>• Bawa identitas diri yang valid</li>
                                <li>• Patuhi peraturan dan tata tertib</li>
                                <li>• Hubungi CS jika ada kendala</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities Info -->
                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <h4 class="font-semibold text-blue-900 mb-3">
                            <i class="fas fa-swimming-pool mr-2"></i>
                            Fasilitas yang Termasuk:
                        </h4>
                        <div class="grid md:grid-cols-2 gap-4 text-sm text-blue-800">
                            <ul class="space-y-1">
                                <li>• Akses semua wahana air</li>
                                <li>• Fasilitas locker</li>
                                <li>• Area parkir gratis</li>
                                <li>• Area food court</li>
                            </ul>
                            <ul class="space-y-1">
                                <li>• Mushola dan toilet</li>
                                <li>• Area bilas</li>
                                <li>• Gazebo dan tempat istirahat</li>
                                <li>• Medical center</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Ticket Footer -->
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                        <div class="text-center sm:text-left">
                            <div class="text-sm text-gray-600">Customer Service</div>
                            <div class="font-semibold text-gray-900">
                                <i class="fas fa-phone mr-1"></i>
                                0411-123456
                            </div>
                        </div>
                        <div class="text-center sm:text-right">
                            <div class="text-sm text-gray-600">Website</div>
                            <div class="font-semibold text-gray-900">
                                <i class="fas fa-globe mr-1"></i>
                                www.grandwaterboommaros.com
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="window.print()"
                    class="flex-1 sm:flex-none bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-print mr-2"></i>
                    Cetak E-Tiket
                </button>

                <button onclick="downloadTicket()"
                    class="flex-1 sm:flex-none bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-download mr-2"></i>
                    Download PDF
                </button>

                <a href="{{ route('tickets.index') }}"
                    class="flex-1 sm:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 px-8 py-4 rounded-xl font-semibold transition-all duration-200 text-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>

            <!-- Share QR Code -->
            <div class="mt-12 text-center">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Bagikan E-Tiket</h3>
                <div class="flex justify-center space-x-4">
                    <button onclick="shareWhatsApp()"
                        class="w-12 h-12 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-whatsapp"></i>
                    </button>
                    <button onclick="shareEmail()"
                        class="w-12 h-12 bg-blue-500 hover:bg-blue-600 text-white rounded-full flex items-center justify-center transition-colors">
                        <i class="fas fa-envelope"></i>
                    </button>
                    <button onclick="copyLink()"
                        class="w-12 h-12 bg-gray-500 hover:bg-gray-600 text-white rounded-full flex items-center justify-center transition-colors">
                        <i class="fas fa-link"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <script>
        function downloadTicket() {
            // This would integrate with a PDF generation service
            alert('Fitur download PDF akan segera tersedia!');
        }

        function shareWhatsApp() {
            const text = encodeURIComponent(
                `Saya sudah membeli e-tiket Grand Waterboom Maros! 🎫🌊\n\nID Tiket: #{{ str_pad($eTicket->id, 6, '0', STR_PAD_LEFT) }}\nAyo main air bareng! 💦`
            );
            window.open(`https://wa.me/?text=${text}`, '_blank');
        }

        function shareEmail() {
            const subject = encodeURIComponent('E-Tiket Grand Waterboom Maros');
            const body = encodeURIComponent(
                `Halo!\n\nSaya sudah membeli e-tiket Grand Waterboom Maros.\n\nID Tiket: #{{ str_pad($eTicket->id, 6, '0', STR_PAD_LEFT) }}\nLink: ${window.location.href}\n\nAyo main air bareng!`
            );
            window.open(`mailto:?subject=${subject}&body=${body}`, '_blank');
        }

        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(function() {
                alert('Link e-tiket berhasil disalin!');
            });
        }
    </script>

    <!-- Print Styles -->
    <style media="print">
        .no-print {
            display: none !important;
        }

        body {
            background: white !important;
        }

        .bg-gradient-to-r {
            background: #3B82F6 !important;
            color: white !important;
        }
    </style>

    <x-footer class="no-print" />
</x-app-layout>
