{{-- @extends('layout.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Beli Tiket</h2>

    @foreach ($tickets as $ticket)
        <div class="bg-white p-4 shadow mb-4 rounded">
            <h3 class="font-bold">{{ $ticket->nama_tiket }}</h3>
            <p>Harga: Rp {{ number_format($ticket->harga, 0, ',', '.') }}</p>
            <form action="{{ url('/transaksi/beli') }}" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <label>Jumlah</label>
                <input type="number" name="jumlah" value="1" class="border p-1 w-20">
                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Beli</button>
            </form>
        </div>
    @endforeach
@endsection --}}
