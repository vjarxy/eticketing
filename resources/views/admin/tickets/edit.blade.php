<x-admin-layout>
    <x-slot name="title">Edit Ticket</x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.tickets.index') }}"
                class="bg-gray-200 text-gray-700 px-3 py-2 rounded-md hover:bg-gray-300 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900"><i class="fas fa-edit mr-2"></i>Edit Ticket</h2>
                <p class="text-gray-600">Ubah data tiket</p>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-ticket-alt mr-1"></i>Nama Ticket
                        </label>
                        <input type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                            id="name" name="name" value="{{ old('name', $ticket->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-dollar-sign mr-1"></i>Harga
                            </label>
                            <input type="number"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('price') border-red-500 @enderror"
                                id="price" name="price" value="{{ old('price', $ticket->price) }}" min="0"
                                step="1000" required>
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-tag mr-1"></i>Type
                            </label>
                            <select
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror"
                                id="type" name="type" required>
                                <option value="">Pilih Type</option>
                                <option value="regular" {{ old('type', $ticket->type) == 'regular' ? 'selected' : '' }}>
                                    Regular
                                </option>
                                <option value="promo" {{ old('type', $ticket->type) == 'promo' ? 'selected' : '' }}>
                                    Promo
                                </option>
                                <option value="paket" {{ old('type', $ticket->type) == 'paket' ? 'selected' : '' }}>
                                    Paket
                                </option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-1"></i>Deskripsi
                        </label>
                        <textarea
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                            id="description" name="description" rows="4">{{ old('description', $ticket->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-toggle-on mr-1"></i>Status
                        </label>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror"
                            id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="aktif" {{ old('status', $ticket->status) == 'aktif' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="non-aktif"
                                {{ old('status', $ticket->status) == 'non-aktif' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                            <i class="fas fa-save mr-1"></i>Update
                        </button>
                        <a href="{{ route('admin.tickets.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                            <i class="fas fa-times mr-1"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
