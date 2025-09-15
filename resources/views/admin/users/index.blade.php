@extends('layout.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Manajemen User</h2>
    <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah User</a>

    <table class="w-full border mt-4">
        <tr class="bg-gray-200">
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        @foreach ($users as $user)
            <tr class="border-b">
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
