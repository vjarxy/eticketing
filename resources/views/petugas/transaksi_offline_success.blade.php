<x-app-layout>
    <x-slot name="title">Transaksi Berhasil</x-slot>

    <div class="max-w-lg mx-auto bg-white shadow-xl rounded-2xl p-8 mt-12 text-center">
        <h2 class="text-2xl font-bold text-green-600 mb-4">Transaksi Berhasil!</h2>
        <p class="text-gray-600 mb-6">Berikut QR Code tiket yang telah dibuat. Silakan simpan atau tunjukkan kepada petugas untuk verifikasi.</p>

        <div class="flex justify-center mb-6">
            <img src="data:image/png;base64,{{ $qrImage }}" alt="QR Code" class="w-48 h-48">
        </div>

        <div class="text-left border-t pt-4">
            <p><strong>Nama Pelanggan:</strong> {{ $transaction->customer_name }}</p>
            <p><strong>Total Pembayaran:</strong> Rp{{ number_format($transaction->total, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
        </div>

        <a href="{{ route('petugas.dashboard') }}"
            class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
            Kembali ke Dashboard (Scan QR)
        </a>
    </div>
</x-app-layout>
