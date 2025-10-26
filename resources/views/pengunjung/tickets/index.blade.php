<x-app-layout>
    <section id="tiket"
        class="relative min-h-[60vh] flex items-center justify-center bg-gradient-to-br from-blue-600 via-blue-700 to-cyan-600 pt-16 overflow-hidden">
        
        <!-- Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/90 via-blue-700/90 to-cyan-600/90"></div>

        <!-- ✅ Alert di pojok kanan atas -->
        @if (session('success'))
            <div class="absolute top-6 right-6 z-50" id="alertBox">
                <div
                    class="bg-green-100 border border-green-400 text-green-700 px-5 py-3 rounded-xl shadow-lg backdrop-blur-md flex items-center space-x-2">
                    <strong class="font-semibold">✔ Berhasil!</strong>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="absolute top-6 right-6 z-50" id="alertBox">
                <div
                    class="bg-red-100 border border-red-400 text-red-700 px-5 py-3 rounded-xl shadow-lg backdrop-blur-md flex items-center space-x-2">
                    <strong class="font-semibold">✖ Gagal!</strong>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center py-20">
            <h1 class="text-5xl font-bold text-white mb-6">Pilih Tiket Masuk</h1>
            <p class="text-xl text-blue-100 mb-10">
                Sistem akan otomatis menyesuaikan harga berdasarkan tanggal kunjungan (termasuk hari libur nasional).
            </p>

            <!-- ✅ Single Ticket Card -->
            <div class="bg-white rounded-2xl shadow-xl p-10 max-w-xl mx-auto border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Tiket Masuk Wisata</h2>
                <p class="text-gray-500 mb-6">Pilih waktu kunjungan Anda di bawah ini.</p>

                <form action="{{ route('tickets.add-to-cart', $tickets->first()) }}" method="POST" id="ticketForm">
                    @csrf

                    <!-- Jumlah -->
                    <div class="mb-4 flex items-center justify-center space-x-3">
                        <label for="quantity" class="text-sm font-medium text-gray-700">Jumlah:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="10"
                            class="w-20 px-3 py-2 text-center border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Waktu Kunjungan -->
                    <div class="mb-6 flex flex-col items-center">
                        <label for="visit_time" class="text-sm font-medium text-gray-700 mb-1">Waktu Kunjungan:</label>
                        <input type="datetime-local" id="visit_time" name="visit_time" required
                            class="w-full sm:w-64 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Harga Otomatis -->
                    <div class="text-lg font-semibold text-gray-800 mb-6">
                        Harga Tiket:
                        <span id="ticketPrice" class="text-blue-600">-</span>
                    </div>

                    <!-- Hidden Price Input -->
                    <input type="hidden" id="priceInput" name="price" value="0">

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white py-3 px-6 rounded-xl transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                        <i class="fas fa-shopping-cart mr-2"></i> Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script>
        // === AUTO CLOSE ALERT ===
        setTimeout(() => {
            const alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.transition = 'opacity 0.5s ease';
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 5000);

        // === FETCH API HARI LIBUR NASIONAL ===
        let hariLiburNasional = [];

        async function loadHolidays() {
            try {
                const year = new Date().getFullYear();
                const response = await fetch(`https://api-harilibur.vercel.app/api?year=${year}`);
                const data = await response.json();
                hariLiburNasional = data
                    .filter(item => item.is_national_holiday)
                    .map(item => item.holiday_date); // format: 'YYYY-MM-DD'
                console.log("✅ Hari libur nasional dimuat:", hariLiburNasional);
            } catch (error) {
                console.error("Gagal memuat data hari libur:", error);
            }
        }

        loadHolidays();

        // === PENYESUAIAN HARGA ===
        const visitTimeInput = document.getElementById('visit_time');
        const priceDisplay = document.getElementById('ticketPrice');
        const priceInput = document.getElementById('priceInput');

        visitTimeInput.addEventListener('change', function () {
            const date = new Date(this.value);
            if (isNaN(date)) return;

            const yyyyMMdd = date.toISOString().split('T')[0];
            const day = date.getDay(); // 0 = Minggu, 6 = Sabtu
            let price = 20000;
            let kategori = "Weekday";

            // Cek hari libur nasional
            if (hariLiburNasional.includes(yyyyMMdd)) {
                price = 40000;
                kategori = "Hari Libur Nasional";
            } else if (day === 0) {
                price = 40000;
                kategori = "Minggu";
            } else if (day === 6) {
                price = 30000;
                kategori = "Sabtu";
            }

            priceDisplay.textContent = `Rp ${price.toLocaleString('id-ID')} (${kategori})`;
            priceInput.value = price;
        });
    </script>
</x-app-layout>
