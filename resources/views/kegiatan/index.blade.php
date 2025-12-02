@extends('layouts.app')

@section('content')
<style>
    .kegiatan-container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 15px;
    }

    .kegiatan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .kegiatan-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1b3b2f;
        margin: 0;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b5e20, #43a047);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(27, 94, 32, 0.3);
        color: white;
    }

    .filter-section {
        background: #f5f5f5;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .filter-section select {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        background: white;
    }

    .kegiatan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .kegiatan-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        cursor: pointer;
        border: 1px solid #f0f0f0;
    }

    .kegiatan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(27, 94, 32, 0.15);
        border-color: #1b5e20;
    }

    .kegiatan-card-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #1b5e20, #43a047);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
        overflow: hidden;
    }

    .kegiatan-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .kegiatan-card-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
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

    .kegiatan-card-body {
        padding: 20px;
        position: relative;
    }

    .kegiatan-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1b3b2f;
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .kegiatan-card-meta {
        font-size: 13px;
        color: #666;
        margin-bottom: 15px;
    }

    .kegiatan-card-meta span {
        display: block;
        margin-bottom: 5px;
    }

    .kegiatan-card-meta-icon {
        margin-right: 6px;
        color: #1b5e20;
    }

    .kegiatan-card-description {
        font-size: 14px;
        color: #555;
        line-height: 1.5;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .kegiatan-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #f0f0f0;
        gap: 10px;
    }

    .kegiatan-status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .kegiatan-btn-detail {
        background: linear-gradient(135deg, #1b5e20, #43a047);
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .kegiatan-btn-detail:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(27, 94, 32, 0.3);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state-icon {
        font-size: 80px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 24px;
        color: #666;
        margin-bottom: 10px;
    }

    .admin-btn-group {
        display: flex;
        gap: 8px;
    }

    .btn-edit, .btn-delete {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
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

    @media (max-width: 768px) {
        .kegiatan-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .kegiatan-grid {
            grid-template-columns: 1fr;
        }

        .filter-section {
            flex-direction: column;
        }

        .filter-section select {
            width: 100%;
        }
    }
</style>

<div class="kegiatan-container">
    {{-- HEADER --}}
    <div class="kegiatan-header">
        <h1>📅 Kegiatan Desa</h1>
        @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('admin.kegiatan.create') }}" class="btn-primary-custom">+ Tambah Kegiatan</a>
        @endif
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div style="background: #e8f5e9; padding: 15px; border-radius: 8px; color: #2e7d32; margin-bottom: 20px; border-left: 4px solid #4caf50;">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTER --}}
    <div class="filter-section">
        <select id="filterStatus" style="flex: 1;">
            <option value="">Semua Status</option>
            <option value="direncanakan">Direncanakan</option>
            <option value="berlangsung">Berlangsung</option>
            <option value="selesai">Selesai</option>
            <option value="dibatalkan">Dibatalkan</option>
        </select>
        <select id="filterKategori" style="flex: 1;">
            <option value="">Semua Kategori</option>
            <option value="Umum">Umum</option>
            <option value="Sosial">Sosial</option>
            <option value="Infrastruktur">Infrastruktur</option>
            <option value="Pendidikan">Pendidikan</option>
            <option value="Kesehatan">Kesehatan</option>
            <option value="Keagamaan">Keagamaan</option>
            <option value="Olahraga">Olahraga</option>
        </select>
    </div>

    {{-- GRID KEGIATAN --}}
    @if($kegiatans->count() > 0)
        <div class="kegiatan-grid" id="kegiatanGrid">
            @foreach($kegiatans as $kegiatan)
                <div class="kegiatan-card" data-status="{{ $kegiatan->status }}" data-kategori="{{ $kegiatan->kategori }}">
                    <div style="position: relative;">
                        <div class="kegiatan-card-image">
                            @if($kegiatan->foto)
                                <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->judul }}">
                            @else
                                <span>📸 Tidak ada gambar</span>
                            @endif
                        </div>
                        <div class="kegiatan-card-badge {{ $kegiatan->status_badge }}">
                            {{ $kegiatan->status_label }}
                        </div>
                    </div>

                    <div class="kegiatan-card-body">
                        <h3 class="kegiatan-card-title">{{ $kegiatan->judul }}</h3>

                        <div class="kegiatan-card-meta">
                            <span><i class="kegiatan-card-meta-icon">📅</i>{{ $kegiatan->tanggal_mulai->format('d M Y, H:i') }}</span>
                            <span><i class="kegiatan-card-meta-icon">📍</i>{{ $kegiatan->lokasi }}</span>
                            <span><i class="kegiatan-card-meta-icon">🏢</i>{{ $kegiatan->penyelenggara }}</span>
                        </div>

                        <p class="kegiatan-card-description">{{ $kegiatan->deskripsi }}</p>

                        @if($kegiatan->jumlah_peserta)
                            <span style="background: #f5f5f5; padding: 4px 10px; border-radius: 4px; font-size: 12px; color: #666;">
                                👥 {{ $kegiatan->jumlah_peserta }} peserta
                            </span>
                        @endif

                        <div class="kegiatan-card-footer">
                            <span class="kegiatan-status {{ $kegiatan->status_badge }}">
                                {{ $kegiatan->kategori }}
                            </span>
                            <div class="admin-btn-group" style="display: flex; gap: 8px;">
                                <a href="{{ route('kegiatan.show', $kegiatan) }}" class="kegiatan-btn-detail">Lihat Detail</a>
                                @if(Auth::check() && Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}" class="btn-edit">Edit</a>
                                    <form action="{{ route('admin.kegiatan.destroy', $kegiatan) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📭</div>
            <h3>Tidak Ada Kegiatan</h3>
            <p>Saat ini belum ada kegiatan desa yang terdaftar.</p>
            @if(Auth::check() && Auth::user()->role === 'admin')
                <br>
                <a href="{{ route('admin.kegiatan.create') }}" class="btn-primary-custom">Buat Kegiatan Pertama</a>
            @endif
        </div>
    @endif
</div>

<script>
    document.getElementById('filterStatus').addEventListener('change', filterKegiatan);
    document.getElementById('filterKategori').addEventListener('change', filterKegiatan);

    function filterKegiatan() {
        const status = document.getElementById('filterStatus').value;
        const kategori = document.getElementById('filterKategori').value;
        const cards = document.querySelectorAll('.kegiatan-card');

        cards.forEach(card => {
            const cardStatus = card.getAttribute('data-status');
            const cardKategori = card.getAttribute('data-kategori');

            const statusMatch = !status || cardStatus === status;
            const kategoriMatch = !kategori || cardKategori === kategori;

            card.style.display = (statusMatch && kategoriMatch) ? 'block' : 'none';
        });
    }
</script>
@endsection
