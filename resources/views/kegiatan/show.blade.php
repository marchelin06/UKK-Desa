@extends('layouts.app')

@section('content')
<style>
    .detail-container {
        max-width: 900px;
        margin: 30px auto;
        padding: 0 15px;
    }

    .detail-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .detail-header a {
        background: #f5f5f5;
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        color: #1b5e20;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .detail-header a:hover {
        background: #e0e0e0;
    }

    .detail-header h1 {
        margin: 0;
        flex: 1;
    }

    .detail-image {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #1b5e20, #43a047);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
    }

    .detail-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .detail-content {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    }

    .detail-section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1b5e20;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #1b5e20;
    }

    .detail-section {
        margin-bottom: 25px;
    }

    .detail-section p {
        color: #555;
        line-height: 1.8;
        margin: 0;
    }

    .detail-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        display: block;
    }

    .detail-value {
        color: #666;
        font-size: 15px;
    }

    .detail-sidebar {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .sidebar-item {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .sidebar-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .sidebar-label {
        font-size: 12px;
        color: #999;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 8px;
        display: block;
    }

    .sidebar-value {
        font-size: 16px;
        font-weight: 700;
        color: #1b5e20;
    }

    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 15px;
    }

    .badge-info {
        background: #e3f2fd;
        color: #1976d2;
    }

    .badge-warning {
        background: #fff3e0;
        color: #f57c00;
    }

    .badge-success {
        background: #e8f5e9;
        color: #388e3c;
    }

    .badge-danger {
        background: #ffebee;
        color: #d32f2f;
    }

    .detail-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .btn-edit, .btn-delete, .btn-back {
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        flex: 1;
        text-align: center;
    }

    .btn-back {
        background: #f5f5f5;
        color: #1b5e20;
    }

    .btn-back:hover {
        background: #e0e0e0;
    }

    .btn-edit {
        background: #ffc107;
        color: white;
    }

    .btn-edit:hover {
        background: #ffb300;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .info-item {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #1b5e20;
    }

    .info-item-label {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .info-item-value {
        font-size: 15px;
        font-weight: 600;
        color: #333;
    }

    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-sidebar {
            position: static;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .detail-actions {
            flex-direction: column;
        }

        .detail-image {
            height: 250px;
        }
    }
</style>

<div class="detail-container">
    {{-- HEADER --}}
    <div class="detail-header">
        <a href="{{ route('kegiatan.index') }}">← Kembali</a>
        <h1>{{ $kegiatan->judul }}</h1>
    </div>

    {{-- IMAGE --}}
    <div class="detail-image">
        @if($kegiatan->foto)
            <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->judul }}">
        @else
            <span>📸 Tidak ada gambar</span>
        @endif
    </div>

    {{-- CONTENT GRID --}}
    <div class="detail-grid">
        {{-- MAIN CONTENT --}}
        <div class="detail-content">
            {{-- DESKRIPSI --}}
            <div class="detail-section">
                <h3 class="detail-section-title">📝 Deskripsi</h3>
                <p>{{ $kegiatan->deskripsi }}</p>
            </div>

            {{-- TUJUAN --}}
            @if($kegiatan->tujuan)
                <div class="detail-section">
                    <h3 class="detail-section-title">🎯 Tujuan</h3>
                    <p>{{ $kegiatan->tujuan }}</p>
                </div>
            @endif

            {{-- HASIL --}}
            @if($kegiatan->hasil)
                <div class="detail-section">
                    <h3 class="detail-section-title">✅ Hasil Kegiatan</h3>
                    <p>{{ $kegiatan->hasil }}</p>
                </div>
            @endif

            {{-- INFO DETAIL --}}
            <div class="detail-section">
                <h3 class="detail-section-title">📋 Informasi Kegiatan</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-item-label">Tanggal Mulai</div>
                        <div class="info-item-value">{{ $kegiatan->tanggal_mulai->format('d M Y, H:i') }}</div>
                    </div>
                    @if($kegiatan->tanggal_selesai)
                        <div class="info-item">
                            <div class="info-item-label">Tanggal Selesai</div>
                            <div class="info-item-value">{{ $kegiatan->tanggal_selesai->format('d M Y, H:i') }}</div>
                        </div>
                    @endif
                    <div class="info-item">
                        <div class="info-item-label">Lokasi</div>
                        <div class="info-item-value">{{ $kegiatan->lokasi }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-item-label">Penyelenggara</div>
                        <div class="info-item-value">{{ $kegiatan->penyelenggara }}</div>
                    </div>
                    @if($kegiatan->penanggung_jawab)
                        <div class="info-item">
                            <div class="info-item-label">Penanggung Jawab</div>
                            <div class="info-item-value">{{ $kegiatan->penanggung_jawab }}</div>
                        </div>
                    @endif
                    @if($kegiatan->jumlah_peserta)
                        <div class="info-item">
                            <div class="info-item-label">Jumlah Peserta</div>
                            <div class="info-item-value">{{ $kegiatan->jumlah_peserta }} orang</div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- PESERTA --}}
            @if($kegiatan->peserta)
                <div class="detail-section">
                    <h3 class="detail-section-title">👥 Peserta</h3>
                    <p>{{ $kegiatan->peserta }}</p>
                </div>
            @endif

            {{-- ANGGARAN --}}
            @if($kegiatan->anggaran)
                <div class="detail-section">
                    <h3 class="detail-section-title">💰 Anggaran</h3>
                    <p><strong>{{ $kegiatan->anggaran }}</strong></p>
                </div>
            @endif
        </div>

        {{-- SIDEBAR --}}
        <div class="detail-sidebar">
            <div class="sidebar-item">
                <span class="sidebar-label">Status</span>
                <span class="status-badge {{ $kegiatan->status_badge }}">
                    {{ $kegiatan->status_label }}
                </span>
            </div>

            <div class="sidebar-item">
                <span class="sidebar-label">Kategori</span>
                <div class="sidebar-value">{{ $kegiatan->kategori_label }}</div>
            </div>

            <div class="sidebar-item">
                <span class="sidebar-label">Dibuat Pada</span>
                <div class="sidebar-value" style="font-size: 13px;">{{ $kegiatan->created_at->format('d M Y, H:i') }}</div>
            </div>

            @if(Auth::check() && Auth::user()->role === 'admin')
                <div class="detail-actions">
                    <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}" class="btn-edit">✎ Edit</a>
                    <form action="{{ route('admin.kegiatan.destroy', $kegiatan) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" style="width: 100%;">🗑️ Hapus</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
