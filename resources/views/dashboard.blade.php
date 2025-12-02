{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    .page-dashboard {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px 20px;
        font-family: 'Poppins', sans-serif;
    }

    .dash-header {
        margin-bottom: 40px;
    }

    .dash-greeting {
        font-size: 36px;
        font-weight: 700;
        color: #1b5e20;
        margin-bottom: 8px;
    }

    .dash-subtext {
        font-size: 15px;
        color: #666;
    }

    .dash-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .quick-action-card {
        background: linear-gradient(135deg, #fff 0%, #f9fbf7 100%);
        border-radius: 16px;
        border: 2px solid #e8f5e9;
        padding: 28px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(27, 94, 32, 0.08);
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    .quick-action-card:hover {
        border-color: #43a047;
        box-shadow: 0 8px 24px rgba(67, 160, 71, 0.15);
        transform: translateY(-6px);
    }

    .quick-action-icon {
        font-size: 40px;
        height: 40px;
    }

    .quick-action-title {
        font-size: 15px;
        font-weight: 700;
        color: #1b5e20;
    }

    .quick-action-desc {
        font-size: 12px;
        color: #888;
        line-height: 1.4;
    }

    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: #1b5e20;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::before {
        content: '';
        width: 4px;
        height: 28px;
        background: linear-gradient(180deg, #43a047 0%, #66bb6a 100%);
        border-radius: 2px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .info-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid rgba(67, 160, 71, 0.1);
        padding: 20px;
        box-shadow: 0 4px 12px rgba(27, 94, 32, 0.08);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        box-shadow: 0 8px 20px rgba(27, 94, 32, 0.12);
    }

    .info-label {
        font-size: 12px;
        color: #999;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 16px;
        font-weight: 700;
        color: #1b5e20;
        word-break: break-word;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 16px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);
        border-radius: 12px;
        padding: 16px;
        color: white;
        text-align: center;
        box-shadow: 0 4px 12px rgba(67, 160, 71, 0.3);
    }

    .stat-number {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 12px;
        opacity: 0.9;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background: linear-gradient(135deg, #f1f8f5 0%, #e8f5e9 100%);
        border-radius: 16px;
        border: 2px dashed #a5d6a7;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 12px;
    }

    .empty-state-text {
        font-size: 15px;
        color: #666;
        margin-bottom: 16px;
    }

    .badge-info {
        display: inline-block;
        background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
        color: #1b5e20;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .page-dashboard {
            padding: 20px 15px;
        }

        .dash-greeting {
            font-size: 26px;
        }

        .dash-grid {
            gap: 16px;
            grid-template-columns: repeat(2, 1fr);
        }

        .section-title {
            font-size: 18px;
        }
    }
</style>

@php
    $u = $user ?? Auth::user();
@endphp

<div class="page-dashboard">
    {{-- GREETING HEADER --}}
    <div class="dash-header">
        <div class="dash-greeting">
            Halo, {{ explode(' ', $u->name ?? 'Warga')[0] }} 👋
        </div>
        <div class="dash-subtext">
            Selamat datang di dashboard Anda. Kelola layanan desa dengan mudah.
        </div>
    </div>

    {{-- QUICK ACTIONS GRID --}}
    <div class="dash-grid">
        <a href="{{ route('surat.index') }}" class="quick-action-card">
            <div class="quick-action-icon">📋</div>
            <div class="quick-action-title">Ajukan Surat</div>
            <div class="quick-action-desc">Buat pengajuan surat desa baru</div>
        </a>

        <a href="{{ route('surat.index') }}" class="quick-action-card">
            <div class="quick-action-icon">📊</div>
            <div class="quick-action-title">Riwayat Surat</div>
            <div class="quick-action-desc">Lihat status pengajuan Anda</div>
        </a>

        <a href="{{ route('kegiatan.index') }}" class="quick-action-card">
            <div class="quick-action-icon">🎉</div>
            <div class="quick-action-title">Kegiatan Desa</div>
            <div class="quick-action-desc">Lihat kegiatan desa</div>
        </a>

        <a href="{{ route('inventaris.public') }}" class="quick-action-card">
            <div class="quick-action-icon">🏛️</div>
            <div class="quick-action-title">Inventaris</div>
            <div class="quick-action-desc">Aset desa yang tersedia</div>
        </a>

        <a href="{{ route('pengaduan.create') }}" class="quick-action-card">
            <div class="quick-action-icon">💬</div>
            <div class="quick-action-title">Pengaduan</div>
            <div class="quick-action-desc">Sampaikan masukan Anda</div>
        </a>

        <a href="{{ route('pengaduan.riwayat') }}" class="quick-action-card">
            <div class="quick-action-icon">📝</div>
            <div class="quick-action-title">Riwayat Pengaduan</div>
            <div class="quick-action-desc">Lihat pengaduan yang Anda kirim</div>
        </a>
    </div>

    {{-- HELPFUL INFO --}}
    <div style="background: linear-gradient(135deg, #fff9c4 0%, #fff59d 100%); border-left: 4px solid #fbc02d; border-radius: 12px; padding: 16px; margin-bottom: 20px; font-size: 14px; color: #856404;">
        <strong>💡 Tip:</strong> Gunakan menu <strong>Layanan Publik</strong> di sidebar kiri untuk mengakses semua fitur dengan mudah.
    </div>
</div>

@endsection
