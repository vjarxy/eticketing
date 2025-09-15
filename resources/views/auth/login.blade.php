@extends('layout.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 shadow rounded">
        <h2 class="text-xl font-bold mb-4">Login</h2>
        <form action="{{ url('/auth/login') }}" method="POST">
            @csrf
            <label>Email</label>
            <input type="email" name="email" class="w-full border p-2 mb-3">

            <label>Password</label>
            <input type="password" name="password" class="w-full border p-2 mb-3">

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Login</button>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Login - E-Ticketing Waterboom')
@section('description', 'Login ke akun Anda untuk mengakses sistem E-Ticketing Waterboom')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Login</h1>
                <p>Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email Anda">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required
                        class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password Anda">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="remember" name="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Ingat saya</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block">
                    Login
                </button>

                <!-- Forgot Password -->
                <div class="auth-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Lupa password?</a>
                    @endif
                </div>
            </form>

            <div class="auth-footer">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .auth-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-header h1 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .auth-header p {
            color: #666;
            margin: 0;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2);
        }

        .btn-block {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
        }

        .auth-links {
            text-align: center;
            margin-top: 1rem;
        }

        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
        }
    </style>
@endpush
