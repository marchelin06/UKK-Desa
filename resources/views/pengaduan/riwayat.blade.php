{{-- resources/views/pengaduan/riwayat.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    .page-riwayat {
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 15px;
        font-family: 'Poppins', sans-serif;
    }

    .page-header {
        margin-bottom: 30px;
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

    .page-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #1b3b2f;
    }

    .page-subtitle {
        color: #666;
        font-size: 14px;
    }

    .card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        padding: 24px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #1b3b2f;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    table thead {
        background: linear-gradient(135deg, #1b5e20 0%, #4caf50 100%);
        color: white;
    }

    table th {
        padding: 12px 15px;
        text-align: left;
        font-weight: 600;
    }

    table td {
        padding: 12px 15px;
        border-bottom: 1px solid #e5e5e5;
    }

    table tbody tr {
        transition: background-color 0.2s ease;
    }

    table tbody tr:hover {
        background-color: #f5f5f5;
    }

    table tbody tr:last-child td {
        border-bottom: none;
    }

    .badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-align: center;
    }

    .badge-diproses {
        background: #fff3cd;
        color: #856404;
    }

    .badge-diterima {
        background: #d4edda;
        color: #155724;
    }

    .badge-selesai {
        background: #cce5ff;
        color: #004085;
    }

    .text-muted {
        color: #999;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.6;
    }

    .empty-state-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .empty-state-text {
        color: #999;
        margin-bottom: 20px;
    }

    .btn-primary {
        display: inline-block;
        background: linear-gradient(135deg, #1b5e20 0%, #4caf50 100%);
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        text-decoration: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(27, 94, 32, 0.3);
    }

    .masalah-text {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .masalah-text[title] {
        cursor: help;
        border-bottom: 1px dotted #ccc;
    }

    @media (max-width: 768px) {
        .page-riwayat {
            margin-top: 20px;
        }

        .page-title {
            font-size: 22px;
        }

        table {
            font-size: 12px;
        }

        table th, table td {
            padding: 8px 10px;
        }

        .masalah-text {
            max-width: 150px;
        }
    }
</style>

<div class="page-riwayat">
    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Riwayat Pengaduan Anda</h1>
            <p class="page-subtitle">
                Berikut adalah daftar pengaduan yang telah Anda kirimkan ke pemerintah desa.
            </p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- TABEL RIWAYAT --}}
    <div class="card">
        <h2 class="card-title">Daftar Pengaduan</h2>

        @if($pengaduan->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">📋</div>
                <div class="empty-state-title">Belum Ada Pengaduan</div>
                <p class="empty-state-text">Anda belum pernah mengirimkan pengaduan. Silakan kirimkan pengaduan atau masukan untuk pemerintah desa.</p>
                <a href="{{ route('pengaduan.create') }}" class="btn-primary">Kirim Pengaduan Baru</a>
            </div>
        @else
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengaduan</th>
                            <th>Nama Pengirim</th>
                            <th>Masalah</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengaduan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                                <td>{{ $item->nama_pengirim }}</td>
                                <td>
                                    <span class="masalah-text" title="{{ $item->masalah }}">
                                        {{ Illuminate\Support\Str::limit($item->masalah, 40, '...') }}
                                    </span>
                                </td>
                                <td>{{ $item->lokasi }}</td>
                                <td>
                                    <span class="badge badge-diterima">Diterima</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- INFO TIPS --}}
    <div class="card" style="margin-top: 20px; background: #f0f7f0; border-left: 4px solid #1b5e20;">
        <h3 style="color: #1b5e20; font-size: 14px; margin-bottom: 8px;">💡 Tips</h3>
        <p style="color: #555; font-size: 13px; margin: 0;">
            Pengaduan yang Anda kirimkan akan ditinjau oleh perangkat desa. Pastikan pengaduan Anda jelas dan informatif agar dapat ditangani dengan baik. Terima kasih atas masukan Anda untuk kemajuan desa.
        </p>
    </div>
</div>

@endsection
