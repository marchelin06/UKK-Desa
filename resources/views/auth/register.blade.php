@extends('layouts.auth')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e8f5e9 0%, #f1f8f5 100%);
        min-height: 100vh;
    }

    .register-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    .register-container {
        width: 100%;
        max-width: 550px;
    }

    .register-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(27, 94, 32, 0.15);
        padding: 48px;
        border: 1px solid rgba(67, 160, 71, 0.1);
    }

    .register-title {
        text-align: center;
        margin-bottom: 32px;
        font-size: 32px;
        font-weight: 700;
        color: #1b5e20;
        letter-spacing: -0.5px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #1b5e20;
        font-size: 14px;
        letter-spacing: 0.2px;
    }

    .form-control {
        width: 100%;
        padding: 12px 14px;
        border: 2px solid #e8f5e9;
        border-radius: 12px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background: #f9fbf7;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #43a047;
        background: #ffffff;
        box-shadow: 0 0 0 5px rgba(67, 160, 71, 0.12);
    }

    .form-control::placeholder {
        color: #a5d6a7;
    }

    .alert {
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 13px;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success {
        background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
        color: #1b5e20;
        border: 1px solid #81c784;
    }

    .alert-warning {
        background: linear-gradient(135deg, #fff9c4 0%, #fff59d 100%);
        color: #856404;
        border: 1px solid #fbc02d;
    }

    .alert ul {
        margin: 0;
        padding-left: 18px;
    }

    .alert li {
        margin-bottom: 6px;
    }

    .btn-register {
        width: 100%;
        background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);
        color: white;
        padding: 14px 20px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(67, 160, 71, 0.3);
        letter-spacing: 0.5px;
        margin-top: 8px;
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #2e7d32 0%, #43a047 100%);
        box-shadow: 0 8px 24px rgba(67, 160, 71, 0.4);
        transform: translateY(-3px);
    }

    .btn-register:active {
        transform: translateY(-1px);
    }

    .register-footer {
        text-align: center;
        margin-top: 24px;
        font-size: 14px;
        color: #666;
    }

    .register-footer a {
        color: #1a7f5a;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .register-footer a:hover {
        color: #145c42;
        text-decoration: underline;
    }

    .form-info {
        font-size: 12px;
        color: #999;
        margin-top: 4px;
    }

    .error-message {
        color: #d32f2f;
        margin-top: 4px;
        display: block;
        font-size: 12px;
        font-weight: 500;
    }

    .form-control.is-invalid {
        border-color: #ef5350;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 5px rgba(239, 83, 80, 0.12);
    }

    @media (max-width: 600px) {
        .register-card {
            padding: 32px 24px;
        }

        .register-title {
            font-size: 28px;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .btn-register {
            padding: 12px 16px;
            font-size: 15px;
        }
    }
</style>

<div class="register-wrapper">
    <div class="register-container">
        <div class="register-card">
            <h2 class="register-title">Register</h2>

            {{-- Error Validasi --}}
            @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="form-group">
                    <label for="name">Nama Lengkap *</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror"
                        placeholder="Masukkan username (opsional)" value="{{ old('username') }}">
                    <small class="form-info">Opsional</small>
                    @error('username')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- NIK --}}
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror"
                        placeholder="Masukkan NIK (opsional)" value="{{ old('nik') }}">
                    <small class="form-info">Opsional</small>
                    @error('nik')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- No HP --}}
                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                        placeholder="Masukkan nomor HP (opsional)" value="{{ old('no_hp') }}">
                    <small class="form-info">Opsional</small>
                    @error('no_hp')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Masukkan email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password (min 6 karakter)" required>
                    <small class="form-info">Minimal 6 karakter</small>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password *</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Konfirmasi password" required>
                    @error('password_confirmation')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-register">
                    Register
                </button>
            </form>

            <div class="register-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </div>
    </div>
</div>

@endsection