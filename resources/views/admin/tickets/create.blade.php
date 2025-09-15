<x-layouts.app>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary me-3">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div>
                        <h2><i class="bi bi-plus-lg me-2"></i>Tambah Ticket</h2>
                        <p class="text-muted mb-0">Buat tiket acara baru</p>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('tickets.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <i class="bi bi-ticket-perforated me-1"></i>Nama Ticket
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">
                                        <i class="bi bi-currency-dollar me-1"></i>Harga
                                    </label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price') }}" min="0"
                                        step="1000" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="type" class="form-label">
                                        <i class="bi bi-tag me-1"></i>Type
                                    </label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type"
                                        name="type" required>
                                        <option value="">Pilih Type</option>
                                        <option value="regular" {{ old('type') == 'regular' ? 'selected' : '' }}>
                                            Regular
                                        </option>
                                        <option value="vip" {{ old('type') == 'vip' ? 'selected' : '' }}>
                                            VIP
                                        </option>
                                        <option value="premium" {{ old('type') == 'premium' ? 'selected' : '' }}>
                                            Premium
                                        </option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">
                                    <i class="bi bi-text-paragraph me-1"></i>Deskripsi
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label">
                                    <i class="bi bi-toggle-on me-1"></i>Status
                                </label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg me-1"></i>Simpan
                                </button>
                                <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-lg me-1"></i>Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
