@extends('layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 0 15px;
    }

    .form-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .form-header a {
        background: #f5f5f5;
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        color: #1b5e20;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .form-header a:hover {
        background: #e0e0e0;
    }

    .form-header h1 {
        margin: 0;
        flex: 1;
    }

    .form-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .form-group label .required {
        color: #dc3545;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #1b5e20;
        box-shadow: 0 0 0 3px rgba(27, 94, 32, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-group-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #1b5e20;
        margin-top: 30px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #1b5e20;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #f0f0f0;
    }

    .btn-submit,
    .btn-cancel {
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        flex: 1;
        text-align: center;
        font-size: 15px;
    }

    .btn-submit {
        background: linear-gradient(135deg, #1b5e20, #43a047);
        color: white;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(27, 94, 32, 0.3);
    }

    .btn-cancel {
        background: #f5f5f5;
        color: #1b5e20;
    }

    .btn-cancel:hover {
        background: #e0e0e0;
    }

    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
        display: block;
    }

    .help-text {
        color: #999;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }

    .alert-error {
        background: #ffebee;
        color: #c62828;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 4px solid #dc3545;
    }

    @media (max-width: 768px) {
        .form-group-row {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }
    }
</style>

<div class="form-container">
    {{-- HEADER --}}
    <div class="form-header">
        <a href="{{ route('kegiatan.index') }}">← Kembali</a>
        <h1>Tambah Kegiatan Baru</h1>
    </div>

    {{-- ERROR MESSAGES --}}
    @if($errors->any())
        <div class="alert-error">
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <div class="form-card">
        <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- INFORMASI DASAR --}}
            <h3 class="form-section-title">📌 Informasi Dasar</h3>

            <div class="form-group">
                <label for="judul">
                    Judul Kegiatan
                    <span class="required">*</span>
                </label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Pembersihan Lingkungan Desa" required>
                @error('judul')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">
                    Deskripsi Kegiatan
                    <span class="required">*</span>
                </label>
                <textarea id="deskripsi" name="deskripsi" placeholder="Jelaskan kegiatan secara detail..." required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tujuan">Tujuan Kegiatan</label>
                <textarea id="tujuan" name="tujuan" placeholder="Apa tujuan diadakan kegiatan ini?">{{ old('tujuan') }}</textarea>
                <span class="help-text">Opsional</span>
            </div>

            <div class="form-group-row">
                <div class="form-group">
                    <label for="kategori">
                        Kategori
                        <span class="required">*</span>
                    </label>
                    <select id="kategori" name="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Umum" {{ old('kategori') === 'Umum' ? 'selected' : '' }}>Umum</option>
                        <option value="Sosial" {{ old('kategori') === 'Sosial' ? 'selected' : '' }}>Sosial</option>
                        <option value="Infrastruktur" {{ old('kategori') === 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                        <option value="Pendidikan" {{ old('kategori') === 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        <option value="Kesehatan" {{ old('kategori') === 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="Keagamaan" {{ old('kategori') === 'Keagamaan' ? 'selected' : '' }}>Keagamaan</option>
                        <option value="Olahraga" {{ old('kategori') === 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                    </select>
                    @error('kategori')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">
                        Status
                        <span class="required">*</span>
                    </label>
                    <select id="status" name="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="direncanakan" {{ old('status') === 'direncanakan' ? 'selected' : '' }}>Direncanakan</option>
                        <option value="berlangsung" {{ old('status') === 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="selesai" {{ old('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ old('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- WAKTU DAN LOKASI --}}
            <h3 class="form-section-title">📅 Waktu & Lokasi</h3>

            <div class="form-group-row">
                <div class="form-group">
                    <label for="tanggal_mulai">
                        Tanggal Mulai
                        <span class="required">*</span>
                    </label>
                    <input type="datetime-local" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                    @error('tanggal_mulai')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="datetime-local" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                    <span class="help-text">Opsional</span>
                    @error('tanggal_selesai')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="lokasi">
                    Lokasi
                    <span class="required">*</span>
                </label>
                <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Lapangan Desa, Balai Desa" required>
                @error('lokasi')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- PENYELENGGARA --}}
            <h3 class="form-section-title">🏢 Penyelenggara</h3>

            <div class="form-group">
                <label for="penyelenggara">
                    Nama Penyelenggara
                    <span class="required">*</span>
                </label>
                <input type="text" id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara', 'Desa') }}" required>
                @error('penyelenggara')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="penanggung_jawab">Penanggung Jawab</label>
                <input type="text" id="penanggung_jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" placeholder="Nama pejabat yang bertanggung jawab">
                <span class="help-text">Opsional</span>
            </div>

            {{-- PESERTA --}}
            <h3 class="form-section-title">👥 Peserta</h3>

            <div class="form-group">
                <label for="jumlah_peserta">Jumlah Peserta</label>
                <input type="number" id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta') }}" min="0" placeholder="Berapa orang yang mengikuti kegiatan ini?">
                <span class="help-text">Opsional</span>
            </div>

            <div class="form-group">
                <label for="peserta">Daftar Peserta</label>
                <textarea id="peserta" name="peserta" placeholder="Sebutkan nama-nama peserta atau kelompok yang terlibat...">{{ old('peserta') }}</textarea>
                <span class="help-text">Opsional</span>
            </div>

            {{-- HASIL & ANGGARAN --}}
            <h3 class="form-section-title">📊 Hasil & Anggaran</h3>

            <div class="form-group">
                <label for="hasil">Hasil Kegiatan</label>
                <textarea id="hasil" name="hasil" placeholder="Apa hasil yang dicapai dari kegiatan ini?">{{ old('hasil') }}</textarea>
                <span class="help-text">Opsional - isi setelah kegiatan selesai</span>
            </div>

            <div class="form-group">
                <label for="anggaran">Anggaran</label>
                <input type="text" id="anggaran" name="anggaran" value="{{ old('anggaran') }}" placeholder="Contoh: Rp 5.000.000">
                <span class="help-text">Opsional</span>
            </div>

            {{-- FOTO --}}
            <h3 class="form-section-title">📸 Foto</h3>

            <div class="form-group">
                <label for="foto">Foto Kegiatan</label>
                <input type="file" id="foto" name="foto" accept="image/*">
                <span class="help-text">Opsional - Format: JPG, PNG, GIF. Maksimal 2MB</span>
                @error('foto')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- ACTIONS --}}
            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Simpan Kegiatan</button>
                <a href="{{ route('kegiatan.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
