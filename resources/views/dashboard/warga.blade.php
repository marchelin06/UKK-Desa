@extends('layouts.app')

@section('title', 'Dashboard Warga - Sistem Informasi Desa')

@section('content')
<style>
    .btn-back {
        background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
        box-shadow: 0 4px 12px rgba(27, 94, 32, 0.2);
    }

    .btn-back:hover {
        background: linear-gradient(135deg, #145c42 0%, #1b5e20 100%);
        color: white;
        transform: translateX(-4px);
        box-shadow: 0 6px 16px rgba(27, 94, 32, 0.3);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="{{ route('home') }}" class="btn-back" style="margin-bottom: 30px;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <div class="card card-custom">
                <div class="card-body p-4">

                    <h2 class="h5 mb-2">
                        Halo, {{ $user->name ?? Auth::user()->name }} 👋
                    </h2>

                    <p class="text-muted mb-4">
                        Selamat datang di Sistem Informasi Desa. Ini adalah halaman khusus untuk warga
                        yang memudahkan Anda mengakses layanan publik desa secara digital.
                    </p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <h2 class="h6 fw-bold mb-1">Pelayanan Surat-Menyurat</h2>
                                <p class="small text-muted mb-3">
                                    Ajukan permohonan surat keterangan tanpa harus antre lama di kantor desa.
                                </p>
                                <a href="{{ route('layanan.surat') }}" class="btn btn-success btn-sm rounded-pill px-3">
                                    Ajukan Surat
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <h2 class="h6 fw-bold mb-1">Informasi Inventaris Desa</h2>
                                <p class="small text-muted mb-3">
                                    Lihat data aset dan inventaris milik desa secara transparan.
                                </p>
                                <a href="{{ route('layanan.inventaris') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">
                                    Lihat Inventaris
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 small text-muted">
                        Butuh bantuan? Silakan hubungi perangkat desa melalui kontak resmi yang tersedia
                        di kantor desa.
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
