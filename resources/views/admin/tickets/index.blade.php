@extends('layout.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Manajemen Tiket</h2>
    <a href="{{ route('tickets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Tiket</a>

    <table class="w-full border mt-4">
        <tr class="bg-gray-200">
            <th>Nama Tiket</th>
            <th>Harga</th>
            <th>Jenis</th>
            <th>Aksi</th>
        </tr>
        @foreach ($tickets as $ticket)
            <tr class="border-b">
                <td>{{ $ticket->nama_tiket }}</td>
                <td>Rp {{ number_format($ticket->harga, 0, ',', '.') }}</td>
                <td>{{ $ticket->jenis }}</td>
                <td>
                    <a href="{{ route('tickets.edit', $ticket) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
