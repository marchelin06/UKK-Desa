@extends('layouts.app')

@section('title', 'Lengkapi Data Diri')

@section('content')
<style>
    .page-content {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px 20px;
        font-family: 'Poppins', sans-serif;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1b5e20;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(27, 94, 32, 0.1);
        padding: 32px;
        border: 1px solid rgba(67, 160, 71, 0.1);
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

    .info-note {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        border-left: 4px solid #43a047;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 24px;
        font-size: 14px;
        color: #1b5e20;
    }

    .button-group {
        display: flex;
        gap: 12px;
        margin-top: 28px;
    }

    .btn {
        flex: 1;
        padding: 14px 20px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);
        color: white;
        box-shadow: 0 4px 16px rgba(67, 160, 71, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #2e7d32 0%, #43a047 100%);
        box-shadow: 0 8px 24px rgba(67, 160, 71, 0.4);
        transform: translateY(-3px);
    }

    .btn-secondary {
        background: #e8e8e8;
        color: #333;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary:hover {
        background: #d0d0d0;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
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

    @media (max-width: 600px) {
        .page-content {
            padding: 20px 15px;
        }

        .card {
            padding: 20px;
        }

        .button-group {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="page-content">
    {{-- PAGE TITLE --}}
    <h1 class="page-title">
        <i class="fas fa-user-edit"></i>
        Lengkapi Data Diri
    </h1>

    {{-- CARD --}}
    <div class="card">
        {{-- INFO NOTE --}}
        <div class="info-note">
            <strong>ℹ️ Informasi:</strong> Silakan lengkapi data diri Anda dengan nomor identitas (NIK) dan nomor telepon untuk melanjutkan.
        </div>

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

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            {{-- NIK --}}
            <div class="form-group">
                <label for="nik">NIK (Nomor Identitas Kependudukan) *</label>
                <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror"
                    placeholder="Masukkan NIK Anda (16 digit)" value="{{ old('nik', $user->nik) }}" required
                    maxlength="16" inputmode="numeric">
                <small class="form-info">Nomor identitas dari KTP Anda</small>
                @error('nik')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- No HP --}}
            <div class="form-group">
                <label for="no_hp">Nomor HP / WhatsApp *</label>
                <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                    placeholder="Masukkan nomor HP Anda (cth: 08123456789)" value="{{ old('no_hp', $user->no_hp) }}" required
                    maxlength="20" inputmode="tel">
                <small class="form-info">Gunakan format 08xxxxx atau dengan kode negara +62</small>
                @error('no_hp')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- BUTTONS --}}
            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
