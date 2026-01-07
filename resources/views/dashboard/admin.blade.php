{{-- resources/views/dashboard/admin.blade.php --}}
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
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .btn-back {
        background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .btn-back:hover {
        background: linear-gradient(135deg, #145c42 0%, #1b5e20 100%);
        color: white;
        transform: translateX(-3px);
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

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 40px;
    }

    .service-card {
        background: #ffffff;
        border-radius: 14px;
        border: 2px solid #e8f5e9;
        padding: 18px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(27, 94, 32, 0.08);
        display: flex;
        flex-direction: column;
    }

    .service-card:hover {
        border-color: #43a047;
        box-shadow: 0 8px 20px rgba(67, 160, 71, 0.15);
        transform: translateY(-4px);
    }

    .service-icon {
        font-size: 32px;
        margin-bottom: 8px;
    }

    .service-title {
        font-size: 14px;
        font-weight: 700;
        color: #1b5e20;
        margin-bottom: 6px;
    }

    .service-desc {
        font-size: 12px;
        color: #666;
        margin-bottom: 12px;
        line-height: 1.5;
        flex-grow: 1;
    }

    .service-link {
        font-size: 13px;
        font-weight: 700;
        color: #1a7f5a;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .service-link:hover {
        color: #145c42;
        transform: translateX(4px);
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

    .info-box {
        background: linear-gradient(135deg, #fff9c4 0%, #fff59d 100%);
        border-left: 4px solid #fbc02d;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
        font-size: 14px;
        color: #856404;
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
    $admin = $admin ?? Auth::user();
@endphp

<div class="page-dashboard">
    {{-- GREETING HEADER --}}
    <div class="dash-header">
        <div>
            <div class="dash-greeting">
                Halo, {{ explode(' ', $admin->name ?? 'Admin')[0] }} 👋
            </div>
            <div class="dash-subtext">
                Selamat datang. Kelola sistem desa dengan efisien.
            </div>
        </div>
        <a href="{{ route('home') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- QUICK ACTIONS GRID --}}
    <div class="dash-grid">
        <a href="{{ route('admin.surat') }}" class="quick-action-card">
            <div class="quick-action-icon">📋</div>
            <div class="quick-action-title">Kelola Surat</div>
            <div class="quick-action-desc">Proses pengajuan surat warga</div>
        </a>

        <a href="{{ route('inventaris.index') }}" class="quick-action-card">
            <div class="quick-action-icon">📊</div>
            <div class="quick-action-title">Inventaris</div>
            <div class="quick-action-desc">Kelola aset desa</div>
        </a>

        <a href="{{ route('pengaduan.index') }}" class="quick-action-card">
            <div class="quick-action-icon">💬</div>
            <div class="quick-action-title">Pengaduan</div>
            <div class="quick-action-desc">Pantau masukan masyarakat</div>
        </a>
    </div>

    {{-- REMINDER BOX --}}
    <div class="info-box">
        <strong>💡 Reminder:</strong> Pastikan status surat diperbarui dan estimasi selesai diisi dengan jelas agar warga tahu kapan harus datang ke kantor desa.
    </div>

    {{-- LAYANAN YANG DIKELOLA --}}
    <h3 class="section-title">Layanan yang Dikelola</h3>
    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon">📋</div>
            <div class="service-title">Surat-Menyurat</div>
            <div class="service-desc">
                Kelola pengajuan surat domisili, SKTM, pengantar KTP, kelahiran, kematian, dan lainnya.
            </div>
            <a href="{{ route('admin.surat') }}" class="service-link">Buka daftar →</a>
        </div>

        <div class="service-card">
            <div class="service-icon">🏛️</div>
            <div class="service-title">Inventaris Aset</div>
            <div class="service-desc">
                Kelola barang milik desa, peralatan, fasilitas umum, dan aset penting lainnya.
            </div>
            <a href="{{ route('inventaris.index') }}" class="service-link">Kelola →</a>
        </div>

        <div class="service-card">
            <div class="service-icon">💬</div>
            <div class="service-title">Pengaduan Masyarakat</div>
            <div class="service-desc">
                Pantau pengaduan dan masukan dari warga tentang layanan atau fasilitas desa.
            </div>
            <a href="{{ route('pengaduan.index') }}" class="service-link">Lihat pengaduan →</a>
        </div>
    </div>
</div>

@endsection
