@extends('layout.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Dashboard Petugas</h2>
    <p>Scan QR Code tiket pengunjung untuk verifikasi.</p>

    <form action="{{ url('/petugas/verifikasi') }}" method="POST" class="mt-4">
        @csrf
        <label>Masukkan Kode QR (contoh: TiketID-1-2)</label>
        <input type="text" name="qr_code" class="border p-2 w-full mb-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Verifikasi</button>
    </form>
@endsection
