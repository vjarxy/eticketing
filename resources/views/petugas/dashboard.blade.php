<x-app-layout>
    <x-slot name="title">Dashboard Petugas - Verifikasi Tiket</x-slot>
    <x-slot name="description">Dashboard untuk verifikasi e-tiket pengunjung</x-slot>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Header -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white mb-4">
                    <i class="fas fa-user-check mr-3"></i>Dashboard Petugas
                </h1>
                <p class="text-xl text-blue-100">
                    Verifikasi e-tiket pengunjung dengan mudah dan cepat
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Status Messages -->
            <div id="status-message" class="mb-6 hidden">
                <div id="success-message"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 hidden">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span id="success-text"></span>
                    </div>
                </div>
                <div id="error-message"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4 hidden">
                    <div class="flex items-center">
                        <i class="fas fa-times-circle mr-2"></i>
                        <span id="error-text"></span>
                    </div>
                </div>
            </div>

            <!-- Verification Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <div class="text-center mb-8">
                    <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-qrcode text-4xl text-blue-600"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Verifikasi E-Tiket</h2>
                    <p class="text-gray-600">Scan QR Code pada e-tiket pengunjung untuk memverifikasi</p>
                </div>

                <!-- QR Scanner Section -->
                <div class="space-y-6">
                    <!-- Camera View -->
                    <div class="relative">
                        <div id="qr-reader" class="w-full max-w-md mx-auto rounded-xl overflow-hidden shadow-lg"></div>
                        <div id="qr-reader-placeholder"
                            class="w-full max-w-md mx-auto bg-gray-100 rounded-xl p-8 text-center">
                            <i class="fas fa-camera text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 mb-4">Klik tombol di bawah untuk memulai scanning</p>
                            <button id="start-scan"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-200">
                                <i class="fas fa-camera mr-2"></i>Mulai Scan QR Code
                            </button>
                        </div>
                    </div>

                    <!-- Manual Input Alternative -->
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">
                            Atau masukkan kode secara manual
                        </h3>
                        <form id="manual-verification-form" class="space-y-4">
                            <div>
                                <label for="qr-code-input" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kode QR E-Tiket
                                </label>
                                <div class="relative">
                                    <input type="text" id="qr-code-input" name="qr_code"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Masukkan kode QR e-tiket" autocomplete="off">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-barcode text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-200">
                                <i class="fas fa-check mr-2"></i>Verifikasi Tiket
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-2xl text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900" id="verified-count">0</p>
                            <p class="text-gray-600">Tiket Terverifikasi</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-times-circle text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900" id="rejected-count">0</p>
                            <p class="text-gray-600">Tiket Ditolak</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900" id="scan-time">--:--</p>
                            <p class="text-gray-600">Waktu Terakhir Scan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Verifications -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 mt-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-history mr-2 text-blue-600"></i>Riwayat Verifikasi Terbaru
                </h3>
                <div id="recent-verifications" class="space-y-4">
                    <div class="text-center text-gray-500 py-8">
                        <i class="fas fa-inbox text-4xl mb-4"></i>
                        <p>Belum ada verifikasi hari ini</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- QR Scanner Library -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

    <script>
        let html5QrcodeScanner;
        let verifiedCount = 0;
        let rejectedCount = 0;

        // Initialize QR Scanner
        function initQRScanner() {
            html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    },
                    aspectRatio: 1.0
                },
                false
            );

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);

            // Hide placeholder and show scanner
            document.getElementById('qr-reader-placeholder').style.display = 'none';
            document.getElementById('qr-reader').style.display = 'block';
        }

        // Handle successful scan
        function onScanSuccess(decodedText, decodedResult) {
            // Stop scanning temporarily
            html5QrcodeScanner.pause(true);

            // Verify the ticket
            verifyTicket(decodedText);

            // Resume scanning after 3 seconds
            setTimeout(() => {
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.resume();
                }
            }, 3000);
        }

        // Handle scan failure
        function onScanFailure(error) {
            // Handle scan failure, usually better to ignore and keep scanning
        }

        // Verify ticket via API
        function verifyTicket(qrCode) {
            fetch('/petugas/verifikasi', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        qr_code: qrCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    updateScanTime();

                    if (data.status === 'success') {
                        showSuccessMessage(data.message);
                        verifiedCount++;
                        updateStats();
                        addToRecentVerifications(qrCode, 'success', data.message, data.data);
                        playSuccessSound();
                    } else {
                        showErrorMessage(data.message);
                        rejectedCount++;
                        updateStats();
                        addToRecentVerifications(qrCode, 'error', data.message);
                        playErrorSound();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorMessage('Terjadi kesalahan saat memverifikasi tiket');
                    rejectedCount++;
                    updateStats();
                    playErrorSound();
                });
        }

        // Show success message
        function showSuccessMessage(message) {
            document.getElementById('success-text').textContent = message;
            document.getElementById('success-message').classList.remove('hidden');
            document.getElementById('error-message').classList.add('hidden');
            document.getElementById('status-message').classList.remove('hidden');

            // Auto hide after 5 seconds
            setTimeout(() => {
                document.getElementById('status-message').classList.add('hidden');
            }, 5000);
        }

        // Show error message
        function showErrorMessage(message) {
            document.getElementById('error-text').textContent = message;
            document.getElementById('error-message').classList.remove('hidden');
            document.getElementById('success-message').classList.add('hidden');
            document.getElementById('status-message').classList.remove('hidden');

            // Auto hide after 5 seconds
            setTimeout(() => {
                document.getElementById('status-message').classList.add('hidden');
            }, 5000);
        }

        // Update statistics
        function updateStats() {
            document.getElementById('verified-count').textContent = verifiedCount;
            document.getElementById('rejected-count').textContent = rejectedCount;
        }

        // Update scan time
        function updateScanTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            document.getElementById('scan-time').textContent = timeString;
        }

        // Add to recent verifications
        function addToRecentVerifications(qrCode, status, message, data = null) {
            const container = document.getElementById('recent-verifications');
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID');

            // Remove the placeholder if it exists
            const placeholder = container.querySelector('.text-center');
            if (placeholder) {
                placeholder.remove();
            }

            const verificationItem = document.createElement('div');
            verificationItem.className = `p-4 rounded-lg border ${
                status === 'success' ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200'
            }`;

            let detailsHtml = '';
            if (status === 'success' && data) {
                detailsHtml = `
                    <div class="mt-2 text-xs text-gray-600 space-y-1">
                        <div><strong>Nama:</strong> ${data.customer_name}</div>
                        <div><strong>Tiket:</strong> ${data.ticket_names}</div>
                        <div><strong>Jumlah:</strong> ${data.total_quantity} tiket</div>
                        <div><strong>Total:</strong> ${data.total_amount}</div>
                        <div><strong>Pembayaran:</strong> ${data.payment_method}</div>
                        ${data.payment_completed ? '<div class="text-green-600 font-medium">💰 Pembayaran tunai berhasil dikonfirmasi!</div>' : ''}
                    </div>
                `;
            }

            verificationItem.innerHTML = `
                <div class="flex items-start justify-between">
                    <div class="flex items-start flex-1">
                        <i class="fas ${status === 'success' ? 'fa-check-circle text-green-500' : 'fa-times-circle text-red-500'} mr-3 mt-1"></i>
                        <div class="flex-1">
                            <p class="text-sm text-gray-800 font-medium">${message}</p>
                            ${detailsHtml}
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 ml-4">${timeString}</div>
                </div>
            `;

            // Add to the beginning of the list
            container.insertBefore(verificationItem, container.firstChild);

            // Keep only the last 5 items
            while (container.children.length > 5) {
                container.removeChild(container.lastChild);
            }
        }

        // Play success sound
        function playSuccessSound() {
            // Create audio context for success sound
            const audioCtx = new(window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioCtx.createOscillator();
            const gainNode = audioCtx.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(audioCtx.destination);

            oscillator.frequency.value = 800;
            oscillator.type = 'sine';
            gainNode.gain.setValueAtTime(0.3, audioCtx.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.5);

            oscillator.start(audioCtx.currentTime);
            oscillator.stop(audioCtx.currentTime + 0.5);
        }

        // Play error sound
        function playErrorSound() {
            // Create audio context for error sound
            const audioCtx = new(window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioCtx.createOscillator();
            const gainNode = audioCtx.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(audioCtx.destination);

            oscillator.frequency.value = 300;
            oscillator.type = 'sawtooth';
            gainNode.gain.setValueAtTime(0.3, audioCtx.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.8);

            oscillator.start(audioCtx.currentTime);
            oscillator.stop(audioCtx.currentTime + 0.8);
        }

        // Load initial statistics
        function loadStats() {
            fetch('/petugas/stats')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('verified-count').textContent = data.data.verified_today;
                        document.getElementById('rejected-count').textContent =
                            data.data.total_tickets_today - data.data.verified_today;
                        verifiedCount = data.data.verified_today;
                        rejectedCount = data.data.total_tickets_today - data.data.verified_today;
                    }
                })
                .catch(error => {
                    console.log('Failed to load statistics:', error);
                });
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Load initial statistics
            loadStats();

            // Add CSRF token to meta tag for API calls
            if (!document.querySelector('meta[name="csrf-token"]')) {
                const meta = document.createElement('meta');
                meta.name = 'csrf-token';
                meta.content = '{{ csrf_token() }}';
                document.getElementsByTagName('head')[0].appendChild(meta);
            }

            // Start scan button
            document.getElementById('start-scan').addEventListener('click', function() {
                initQRScanner();
            });

            // Manual verification form
            document.getElementById('manual-verification-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const qrCode = document.getElementById('qr-code-input').value.trim();

                if (qrCode) {
                    verifyTicket(qrCode);
                    document.getElementById('qr-code-input').value = '';
                } else {
                    showErrorMessage('Mohon masukkan kode QR e-tiket');
                }
            });

            // Auto-focus on manual input when typing
            document.getElementById('qr-code-input').addEventListener('input', function() {
                // Clear any existing messages when user starts typing
                document.getElementById('status-message').classList.add('hidden');
            });
        });
    </script>
</x-app-layout>
