@extends('layouts.app')

@section('title', 'Layanan Pengaduan Masyarakat')

@section('content')
<style>
    .pengaduan-container {
        max-width: 700px;
        margin: 40px auto;
        padding: 0 15px;
    }

    .pengaduan-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 12px 36px rgba(27, 94, 32, 0.12);
        border: 1px solid rgba(67, 160, 71, 0.1);
        overflow: hidden;
    }

    .pengaduan-header {
        background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
        color: white;
        padding: 28px;
        text-align: center;
    }

    .pengaduan-header h4 {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
        letter-spacing: 0.3px;
    }

    .pengaduan-body {
        padding: 32px;
    }

    .pengaduan-intro {
        color: #666;
        margin-bottom: 24px;
        font-size: 14px;
        line-height: 1.6;
        padding: 16px;
        background: linear-gradient(135deg, #f1f8f5 0%, #e8f5e9 100%);
        border-radius: 12px;
        border-left: 4px solid #43a047;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        font-weight: 700;
        color: #1b5e20;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
        letter-spacing: 0.3px;
    }

    .form-control {
        border: 2px solid #e8f5e9;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background: #f9fbf7;
    }

    .form-control:focus {
        border-color: #43a047;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(67, 160, 71, 0.1);
        outline: none;
    }

    .form-control::placeholder {
        color: #a5d6a7;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 140px;
    }

    .form-text {
        font-size: 12px;
        color: #888;
        margin-top: 6px;
        display: block;
    }

    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 20px;
        animation: slideIn 0.4s ease;
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
    }

    .alert-danger {
        background: linear-gradient(135deg, #ffcdd2 0%, #ef9a9a 100%);
        color: #c62828;
    }

    .alert-danger ul {
        margin-bottom: 0;
        margin-top: 8px;
    }

    .invalid-feedback {
        color: #d32f2f;
        font-size: 12px;
        margin-top: 6px;
        display: block;
        animation: slideIn 0.3s ease;
    }

    .form-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 32px;
    }

    .btn {
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        letter-spacing: 0.3px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .btn-outline-secondary {
        background: #f1f8f5;
        color: #1b5e20;
        border: 2px solid #a5d6a7;
    }

    .btn-outline-secondary:hover {
        background: #a5d6a7;
        color: #1b5e20;
        box-shadow: 0 6px 18px rgba(165, 214, 167, 0.4);
        transform: translateY(-2px);
    }

    .btn-success {
        background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);
        color: white;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #2e7d32 0%, #43a047 100%);
        box-shadow: 0 6px 18px rgba(67, 160, 71, 0.4);
        transform: translateY(-2px);
    }

    .required {
        color: #d32f2f;
    }

    @media (max-width: 600px) {
        .pengaduan-body {
            padding: 20px;
        }

        .form-actions {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="pengaduan-container">
    <div class="pengaduan-card">
        <div class="pengaduan-header">
            <h4>📋 Layanan Pengaduan Masyarakat</h4>
        </div>
        <div class="pengaduan-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>⚠️ Validasi Gagal!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>✓ Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="pengaduan-intro">
                💬 Silakan sampaikan pengaduan atau masukan Anda kepada kami. Kami akan meninjau dan merespons pengaduan Anda dengan sebaik mungkin.
            </div>

            <form action="{{ route('pengaduan.store') }}" method="POST">
                @csrf

                {{-- Nama Pengirim --}}
                <div class="form-group">
                    <label for="nama_pengirim" class="form-label">
                        Nama Pengirim <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control @error('nama_pengirim') is-invalid @enderror"
                           id="nama_pengirim" name="nama_pengirim" placeholder="Masukkan nama lengkap Anda"
                           value="{{ old('nama_pengirim') }}" required>
                    @error('nama_pengirim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Masalah/Pengaduan --}}
                <div class="form-group">
                    <label for="masalah" class="form-label">
                        Masalah yang Diadukan <span class="required">*</span>
                    </label>
                    <textarea class="form-control @error('masalah') is-invalid @enderror"
                              id="masalah" name="masalah"
                              placeholder="Jelaskan masalah atau keluhan Anda secara detail..."
                              required>{{ old('masalah') }}</textarea>
                    <span class="form-text">Minimal 10 karakter</span>
                    @error('masalah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div class="form-group">
                    <label for="lokasi" class="form-label">
                        Lokasi <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                           id="lokasi" name="lokasi" placeholder="Masukkan lokasi kejadian atau keluhan"
                           value="{{ old('lokasi') }}" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Submit --}}
                <div class="form-actions">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                        ← Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        ✓ Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
