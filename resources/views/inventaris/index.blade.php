@extends('layouts.app')

@section('title', 'Inventaris Desa')

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

    .btn-tambah {
        background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(67, 160, 71, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .btn-tambah:hover {
        background: linear-gradient(135deg, #2e7d32 0%, #43a047 100%);
        box-shadow: 0 6px 18px rgba(67, 160, 71, 0.4);
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }

    .alert {
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 14px;
        animation: slideIn 0.3s ease;
    }

    .alert-success {
        background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
        color: #1b5e20;
        border: 1px solid #81c784;
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

    .badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-baik {
        background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
        color: #1b5e20;
    }

    .badge-ringan {
        background: linear-gradient(135deg, #fff9c4 0%, #fff59d 100%);
        color: #856404;
    }

    .badge-berat {
        background: linear-gradient(135deg, #ffccbc 0%, #ffab91 100%);
        color: #bf360c;
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

    .btn-edit {
        background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
        color: #fff;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #1565c0 0%, #0d47a1 100%);
        box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-delete {
        background: linear-gradient(135deg, #f44336 0%, #e53935 100%);
        color: #fff;
        border: none;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #d32f2f 0%, #c62828 100%);
        box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
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
            <h1 class="page-title">Inventaris Desa</h1>
            <p class="page-subtitle">Kelola aset dan barang milik desa</p>
        </div>
        <a href="{{ route('inventaris.create') }}" class="btn-tambah">
            <i class="fas fa-plus"></i> Tambah Barang
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="card-table">
        @if($data->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Barang</th>
                        <th width="80">Jumlah</th>
                        <th width="120">Kondisi</th>
                        <th>Lokasi</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        @php
                            $badgeClass = match($item->kondisi) {
                                'Baik'          => 'badge-baik',
                                'Rusak Ringan'  => 'badge-ringan',
                                'Rusak Berat'   => 'badge-berat',
                                default         => 'badge-baik',
                            };
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item->nama_barang }}</strong></td>
                            <td>{{ $item->jumlah }}</td>
                            <td>
                                <span class="badge {{ $badgeClass }}">{{ $item->kondisi }}</span>
                            </td>
                            <td>{{ $item->lokasi }}</td>
                            <td>
                                <a href="{{ route('inventaris.show', $item->id) }}" class="btn-action btn-detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('inventaris.edit', $item->id) }}" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📦</div>
                <div class="empty-state-text">Belum ada data inventaris yang tercatat</div>
                <p style="margin-top: 16px;">
                    <a href="{{ route('inventaris.create') }}" class="btn-tambah">
                        <i class="fas fa-plus"></i> Tambah Barang Pertama
                    </a>
                </p>
            </div>
        @endif
    </div>
</div>

@endsection
