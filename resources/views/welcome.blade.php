<x-layouts.app>
    <div class="container">
        <!-- Hero Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <div class="bg-white rounded-3 shadow-sm p-5">
                    <i class="bi bi-ticket-perforated text-primary" style="font-size: 4rem;"></i>
                    <h1 class="display-4 fw-bold text-primary mt-3">E-Ticket System</h1>
                    <p class="lead text-muted">Sistem manajemen tiket elektronik yang modern dan efisien untuk semua
                        kebutuhan acara Anda.</p>

                    @guest
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a>
                            <a href="{{ url('auth/register') }}" class="btn btn-outline-primary btn-lg px-4">
                                <i class="bi bi-person-plus me-2"></i>Register
                            </a>
                        </div>
                    @else
                        <div class="mt-4">
                            <h5 class="text-success">
                                <i class="bi bi-check-circle me-2"></i>Selamat datang, {{ auth()->user()->name }}!
                            </h5>
                            <p class="text-muted">Role: {{ ucfirst(auth()->user()->role) }}</p>

                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('users.index') }}" class="btn btn-primary me-2">
                                    <i class="bi bi-people me-1"></i>Kelola Users
                                </a>
                                <a href="{{ route('tickets.index') }}" class="btn btn-primary">
                                    <i class="bi bi-ticket me-1"></i>Kelola Tickets
                                </a>
                            @elseif(auth()->user()->role === 'petugas')
                                <a href="{{ url('petugas/dashboard') }}" class="btn btn-primary">
                                    <i class="bi bi-speedometer2 me-1"></i>Dashboard Petugas
                                </a>
                            @elseif(auth()->user()->role === 'pengunjung')
                                <a href="{{ url('transaksi') }}" class="btn btn-primary">
                                    <i class="bi bi-cart me-1"></i>Beli Tiket
                                </a>
                            @endif
                        </div>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-shield-check text-success" style="font-size: 3rem;"></i>
                        <h5 class="card-title mt-3">Aman & Terpercaya</h5>
                        <p class="card-text text-muted">Sistem keamanan berlapis untuk melindungi data dan transaksi
                            Anda.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-lightning text-warning" style="font-size: 3rem;"></i>
                        <h5 class="card-title mt-3">Cepat & Mudah</h5>
                        <p class="card-text text-muted">Proses pembelian tiket yang cepat dengan antarmuka yang
                            user-friendly.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-qr-code text-info" style="font-size: 3rem;"></i>
                        <h5 class="card-title mt-3">QR Code Digital</h5>
                        <p class="card-text text-muted">Tiket digital dengan QR code untuk kemudahan verifikasi dan
                            akses.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
