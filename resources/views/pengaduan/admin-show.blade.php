@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
<style>
    .page-content {
        max-width: 900px;
        margin: 0 auto;
        padding: 30px 20px;
        font-family: 'Poppins', sans-serif;
    }

    .page-back {
        margin-bottom: 20px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: linear-gradient(135deg, #f1f8f5 0%, #e8f5e9 100%);
        color: #1b5e20;
        border: 2px solid #a5d6a7;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .btn-back:hover {
        background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
        color: #1b5e20;
        text-decoration: none;
    }

    .card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(27, 94, 32, 0.1);
        padding: 32px;
        border: 1px solid rgba(67, 160, 71, 0.1);
        margin-bottom: 24px;
    }

    .card-title {
        font-size: 20px;
        font-weight: 700;
        color: #1b5e20;
        margin-bottom: 24px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e8f5e9;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-row {
        display: grid;
        grid-template-columns: 150px 1fr;
        gap: 24px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e8f5e9;
    }

    .info-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .info-label {
        font-weight: 700;
        color: #1b5e20;
        font-size: 14px;
    }

    .info-value {
        color: #333;
        font-size: 15px;
        line-height: 1.6;
    }

    .badge-status {
        display: inline-block;
        background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
        color: #1b5e20;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .page-content {
            padding: 20px 15px;
        }

        .card {
            padding: 20px;
        }

        .info-row {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .info-label {
            font-size: 12px;
        }

        .info-value {
            font-size: 14px;
        }
    }
</style>

<div class="page-content">
    {{-- BACK BUTTON --}}
    <div class="page-back">
        <a href="{{ route('pengaduan.index') }}" class="btn-back">
            <i class="fas fa-chevron-left"></i> Kembali ke Daftar
        </a>
    </div>

    {{-- DETAIL CARD --}}
    <div class="card">
        <div class="card-title">
            <i class="fas fa-comments"></i>
            Detail Pengaduan
        </div>

        <div class="info-row">
            <div class="info-label">Nama Pengirim</div>
            <div class="info-value">{{ $pengaduan->nama_pengirim }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Lokasi Masalah</div>
            <div class="info-value">{{ $pengaduan->lokasi }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Tanggal Pengaduan</div>
            <div class="info-value">{{ $pengaduan->created_at->format('d F Y H:i') }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Status</div>
            <div class="info-value">
                <span class="badge-status">Diterima</span>
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">Deskripsi Masalah</div>
            <div class="info-value" style="white-space: pre-wrap;">{{ $pengaduan->masalah }}</div>
        </div>
    </div>
</div>

@endsection
