@extends('layouts.auth')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e8f5e9 0%, #f1f8f5 100%);
        min-height: 100vh;
    }

    .login-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    .login-container {
        width: 100%;
        max-width: 500px;
    }

    .login-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(27, 94, 32, 0.15);
        padding: 48px;
        border: 1px solid rgba(67, 160, 71, 0.1);
    }

    .login-title {
        text-align: center;
        margin-bottom: 32px;
        font-size: 32px;
        font-weight: 700;
        color: #1b5e20;
        letter-spacing: -0.5px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: #1b5e20;
        font-size: 15px;
        letter-spacing: 0.3px;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e8f5e9;
        border-radius: 12px;
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background: #f9fbf7;
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
        font-size: 14px;
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

    .alert-danger {
        background: linear-gradient(135deg, #ffcdd2 0%, #ef9a9a 100%);
        color: #c62828;
        border: 1px solid #ef5350;
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

    .btn-login {
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

    .btn-login:hover {
        background: linear-gradient(135deg, #2e7d32 0%, #43a047 100%);
        box-shadow: 0 8px 24px rgba(67, 160, 71, 0.4);
        transform: translateY(-3px);
    }

    .btn-login:active {
        transform: translateY(-1px);
    }

    .login-footer {
        text-align: center;
        margin-top: 24px;
        font-size: 14px;
        color: #666;
    }

    .login-footer a {
        color: #1a7f5a;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .login-footer a:hover {
        color: #145c42;
        text-decoration: underline;
    }

    .error-message {
        color: #d32f2f;
        margin-top: 6px;
        display: block;
        font-size: 13px;
        font-weight: 500;
    }

    .form-control.is-invalid {
        border-color: #ef5350;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 5px rgba(239, 83, 80, 0.12);
    }

    @media (max-width: 600px) {
        .login-card {
            padding: 32px 24px;
        }

        .login-title {
            font-size: 28px;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .btn-login {
            padding: 12px 16px;
            font-size: 15px;
        }
    }
</style>

<div class="login-wrapper">
    <div class="login-container">
        <div class="login-card">
            <h2 class="login-title">Login User</h2>

            {{-- Notifikasi Success --}}
            @if (session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            {{-- Notifikasi Error Login --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    ✕ {{ session('error') }}
                </div>
            @endif

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

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email"
                        name="email" 
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Masukkan email"
                        value="{{ old('email') }}" 
                        required
                        autofocus>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password"
                        name="password" 
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password"
                        required>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    Login
                </button>
            </form>

            <div class="login-footer">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
        </div>
    </div>
</div>

@endsection