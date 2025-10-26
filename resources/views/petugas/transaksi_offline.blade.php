<x-app-layout>
    <x-slot name="title">Transaksi Offline</x-slot>
    <div class="max-w-lg mx-auto bg-white shadow-lg rounded-xl p-8 mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Transaksi Offline</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('petugas.transaksi.offline.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Pelanggan</label>
                <input type="text" name="customer_name" class="w-full border rounded-lg p-3" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Pilih Tiket</label>
                <select name="ticket_id" class="w-full border rounded-lg p-3" required>
                    <option value="">-- Pilih Tiket --</option>
                    @foreach ($tickets as $ticket)
                        <option value="{{ $ticket->id }}">{{ $ticket->name }} - Rp{{ number_format($ticket->price, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Jumlah Tiket</label>
                <input type="number" name="quantity" class="w-full border rounded-lg p-3" min="1" required>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white w-full py-3 rounded-lg font-semibold">
                Buat Transaksi
            </button>
        </form>
    </div>
</x-app-layout>
