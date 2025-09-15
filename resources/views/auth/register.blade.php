@extends('layout.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 shadow rounded">
        <h2 class="text-xl font-bold mb-4">Register</h2>
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <label>Nama</label>
            <input type="text" name="name" class="w-full border p-2 mb-3">

            <label>Email</label>
            <input type="email" name="email" class="w-full border p-2 mb-3">

            <label>Password</label>
            <input type="password" name="password" class="w-full border p-2 mb-3">

            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 mb-3">

            <button type="submit" class="w-full bg-green-600 text-white p-2 rounded">Daftar</button>
        </form>
    </div>
@endsection
