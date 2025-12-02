@extends('layouts.app')

@section('title', 'Daftar Pengaduan Masyarakat')

@section('content')
<style>
    .page-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px 20px;
        font-family: 'Poppins', sans-serif;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1b5e20;
        margin: 0;
    }

    .page-subtitle {
        font-size: 14px;
        color: #666;
        margin-top: 6px;
    }

    .card-table {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(27, 94, 32, 0.1);
        padding: 24px;
        border: 1px solid rgba(67, 160, 71, 0.1);
        overflow: hidden;
    }

    .table {
        margin: 0;
        font-size: 14px;
    }

    .table thead th {
        background: linear-gradient(135deg, #f1f8f5 0%, #e8f5e9 100%);
        border-bottom: 2px solid #a5d6a7;
        font-weight: 700;
        color: #1b5e20;
        padding: 14px 12px;
        text-align: left;
    }

    .table tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid #e8f5e9;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background: linear-gradient(90deg, rgba(67, 160, 71, 0.03) 0%, transparent 100%);
    }

    .btn-action {
        padding: 6px 12px;
        border-radius: 8px;
        border: none;
        font-size: 12px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-right: 4px;
        display: inline-block;
    }

    .btn-detail {
        background: linear-gradient(135deg, #1a7f5a 0%, #2e7d32 100%);
        color: #fff;
    }

    .btn-detail:hover {
        background: linear-gradient(135deg, #145c42 0%, #1a7f5a 100%);
        box-shadow: 0 4px 12px rgba(26, 127, 90, 0.3);
        color: white;
        text-decoration: none;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 12px;
    }

    .empty-state-text {
        font-size: 16px;
        color: #666;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        color: #1565c0;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .table {
            font-size: 12px;
        }

        .table thead th,
        .table tbody td {
            padding: 10px 8px;
        }

        .btn-action {
            padding: 4px 8px;
            font-size: 11px;
            margin-bottom: 4px;
        }
    }
</style>

<div class="page-content">
    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Daftar Pengaduan Masyarakat</h1>
            <p class="page-subtitle">Pantau pengaduan dan masukan dari warga</p>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card-table">
        @if($pengaduan->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Pengirim</th>
                        <th>Masalah</th>
                        <th>Lokasi</th>
                        <th width="120">Tanggal</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item->nama_pengirim }}</strong></td>
                            <td>
                                <span title="{{ $item->masalah }}">
                                    {{ Str::limit($item->masalah, 50) }}
                                </span>
                            </td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('pengaduan.show', $item->id) }}" class="btn-action btn-detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">💬</div>
                <div class="empty-state-text">Belum ada pengaduan dari masyarakat</div>
            </div>
        @endif
    </div>
</div>

@endsection
