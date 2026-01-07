@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<style>
    .page-content {
        max-width: 900px;
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
        justify-content: space-between;
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

    .card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(27, 94, 32, 0.1);
        padding: 32px;
        border: 1px solid rgba(67, 160, 71, 0.1);
        margin-bottom: 24px;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 32px;
        padding-bottom: 24px;
        border-bottom: 2px solid #e8f5e9;
    }

    .avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 48px;
        flex-shrink: 0;
    }

    .profile-info h2 {
        font-size: 24px;
        font-weight: 700;
        color: #1b5e20;
        margin: 0 0 8px 0;
    }

    .profile-info p {
        color: #666;
        margin: 0;
        font-size: 14px;
    }

    .badge-role {
        display: inline-block;
        background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
        color: #1b5e20;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        margin-top: 8px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
    }

    .info-item {
        padding: 20px;
        background: linear-gradient(135deg, #f1f8f5 0%, #e8f5e9 100%);
        border-radius: 12px;
        border-left: 4px solid #43a047;
    }

    .info-label {
        font-size: 12px;
        color: #999;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .info-value {
        font-size: 16px;
        font-weight: 700;
        color: #1b5e20;
        word-break: break-word;
    }

    .info-note {
        background: linear-gradient(135deg, #fff9c4 0%, #fff59d 100%);
        border-left: 4px solid #fbc02d;
        border-radius: 8px;
        padding: 16px;
        margin-top: 24px;
        font-size: 14px;
        color: #856404;
    }

    @media (max-width: 768px) {
        .page-content {
            padding: 20px 15px;
        }

        .card {
            padding: 20px;
        }

        .profile-header {
            flex-direction: column;
            text-align: center;
        }

        .avatar {
            width: 80px;
            height: 80px;
            font-size: 36px;
        }

        .profile-info h2 {
            font-size: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-content">
    {{-- PAGE TITLE --}}
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <h1 class="page-title">
            <i class="fas fa-user-circle"></i>
            Profil Saya
        </h1>
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- PROFILE CARD --}}
    <div class="card">
        <div class="profile-header">
            <div class="avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="profile-info">
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>
                <span class="badge-role">
                    @if($user->role === 'admin')
                        <i class="fas fa-shield-alt"></i> Admin Desa
                    @else
                        <i class="fas fa-home"></i> Warga Desa
                    @endif
                </span>
            </div>
        </div>

        {{-- INFO GRID --}}
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value">{{ $user->name }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value" style="font-size: 14px; word-break: break-all;">{{ $user->email }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Role / Peran</div>
                <div class="info-value">
                    @if($user->role === 'admin')
                        Administrator Sistem
                    @else
                        Masyarakat / Warga
                    @endif
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Bergabung Sejak</div>
                <div class="info-value">{{ $user->created_at->format('d F Y') }}</div>
            </div>

            @if($user->nik)
                <div class="info-item">
                    <div class="info-label">NIK</div>
                    <div class="info-value">{{ $user->nik }}</div>
                </div>
            @endif

            @if($user->no_hp)
                <div class="info-item">
                    <div class="info-label">Nomor HP</div>
                    <div class="info-value">{{ $user->no_hp }}</div>
                </div>
            @endif
        </div>

        {{-- INFO NOTE --}}
        <div class="info-note">
            <strong>ℹ️ Informasi:</strong> Data profil Anda ditampilkan berdasarkan data yang terdaftar di sistem. Untuk mengubah informasi profil, silakan hubungi perangkat desa.
        </div>
    </div>
</div>

@endsection
