{{-- resources/views/surat/warga.blade.php --}}
@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<style>
    .page-surat {
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 15px;
        font-family: Arial, sans-serif;
    }

    .page-surat-header {
        margin-bottom: 20px;
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

    .page-surat-title {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #1b3b2f;
    }

    .page-surat-subtitle {
        color: #555;
        font-size: 14px;
    }

    .page-surat-layout {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        padding: 20px;
        flex: 1 1 320px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #1b3b2f;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    .form-control, .form-select, textarea {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #ccd0d5;
        border-radius: 5px;
        font-size: 14px;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        outline: none;
        border-color: #1a7f5a;
        box-shadow: 0 0 0 2px rgba(26,127,90,0.15);
    }

    .form-control.is-invalid,
    .form-select.is-invalid,
    textarea.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 2px rgba(220,53,69,0.15);
    }

    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus,
    textarea.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220,53,69,0.25);
    }

    .date-input[type="date"]:disabled {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }

    .btn-primary {
        background: #1a7f5a;
        border: none;
        color: #fff;
        padding: 9px 18px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .btn-primary:hover {
        background: #145c42;
    }

    .alert {
        padding: 10px 14px;
        border-radius: 6px;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .alert-success {
        background: #e6f7ec;
        border: 1px solid #b6e2c5;
        color: #1a7f5a;
    }

    .alert-danger {
        background: #fdecea;
        border: 1px solid #f5c2c0;
        color: #b02a37;
    }

    .badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-menunggu {
        background: #fff3cd;
        color: #856404;
    }

    .badge-disetujui {
        background: #d4edda;
        color: #155724;
    }

    .badge-ditolak {
        background: #f8d7da;
        color: #721c24;
    }

    .table-wrapper {
        margin-top: 10px;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    table thead {
        background: #f4f6f8;
    }

    table th, table td {
        padding: 8px 10px;
        border-bottom: 1px solid #e2e5e9;
        text-align: left;
        white-space: nowrap;
    }

    table th {
        font-weight: 600;
        color: #444;
    }

    .text-muted {
        color: #777;
        font-size: 13px;
    }

    .badge-mode {
        font-size: 11px;
        padding: 3px 7px;
        border-radius: 999px;
        background: #e3f2fd;
        color: #1565c0;
        margin-left: 4px;
    }

    .mode-help {
        font-size: 12px;
        color: #666;
    }

    .section-online-detail {
        margin-top: 15px;
        padding: 12px 14px;
        border-radius: 8px;
        background: #f1f8e9;
        border: 1px solid #d4e6b5;
    }

    .section-online-detail h3 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #33691e;
    }

    .section-online-detail small {
        font-size: 12px;
        color: #555;
    }

    @media (max-width: 768px) {
        .page-surat {
            margin-top: 20px;
        }
        .page-surat-layout {
            flex-direction: column;
        }
    }

    /* Tooltip untuk Catatan Admin */
    .catatan-admin-link {
        cursor: help;
        text-decoration: underline dotted;
        color: #1a7f5a;
        position: relative;
        display: inline-block;
        transition: all 0.2s ease;
    }

    .catatan-admin-link:hover {
        color: #145c42;
        font-weight: 500;
    }

    .catatan-admin-tooltip {
        visibility: hidden;
        width: 250px;
        background-color: #1b5e20;
        color: #fff;
        text-align: left;
        border-radius: 8px;
        padding: 10px 12px;
        position: absolute;
        z-index: 1000;
        bottom: 125%;
        left: 50%;
        margin-left: -125px;
        opacity: 0;
        transition: opacity 0.3s ease;
        font-weight: normal;
        font-size: 12px;
        white-space: normal;
        box-shadow: 0 4px 12px rgba(27, 94, 32, 0.2);
        word-wrap: break-word;
        max-height: 150px;
        overflow-y: auto;
    }

    .catatan-admin-tooltip::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #1b5e20 transparent transparent transparent;
    }

    .catatan-admin-link:hover .catatan-admin-tooltip {
        visibility: visible;
        opacity: 1;
    }
</style>

<div class="page-surat">
    {{-- HEADER --}}
    <div class="page-surat-header">
        <div>
            <h1 class="page-surat-title">Pengajuan Surat Desa</h1>
            <p class="page-surat-subtitle">
                Ajukan permohonan surat keterangan secara online. Pastikan data yang Anda isi sudah benar.
            </p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin: 5px 0 0 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="page-surat-layout">
        {{-- FORM PENGAJUAN --}}
        <div class="card">
            <h2 class="card-title">Form Pengajuan Surat</h2>

            <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipe_pengajuan" value="online">

                {{-- JENIS SURAT --}}
                <div class="form-group">
                    <label for="jenis_surat">Jenis Surat</label>
                    <select name="jenis_surat" id="jenis_surat" class="form-select" required>
                        <option value="">-- Pilih Jenis Surat --</option>
                        <option value="Surat Domisili" {{ old('jenis_surat')=='Surat Domisili' ? 'selected' : '' }}>Surat Domisili</option>
                        <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat')=='Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu (SKTM)</option>
                        <option value="Surat Pengantar KTP" {{ old('jenis_surat')=='Surat Pengantar KTP' ? 'selected' : '' }}>Surat Pengantar KTP</option>
                        <option value="Surat Kelahiran" {{ old('jenis_surat')=='Surat Kelahiran' ? 'selected' : '' }}>Surat Kelahiran</option>
                        <option value="Surat Kematian" {{ old('jenis_surat')=='Surat Kematian' ? 'selected' : '' }}>Surat Kematian</option>
                        <option value="Surat Pengantar KUA" {{ old('jenis_surat')=='Surat Pengantar KUA' ? 'selected' : '' }}>Surat Pengantar KUA</option>
                        <option value="Surat Keterangan Usaha" {{ old('jenis_surat')=='Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
                        <option value="Surat Keterangan Belum Menikah" {{ old('jenis_surat')=='Surat Keterangan Belum Menikah' ? 'selected' : '' }}>Surat Keterangan Belum Menikah</option>
                        <option value="Surat Keterangan Tanah" {{ old('jenis_surat')=='Surat Keterangan Tanah' ? 'selected' : '' }}>Surat Keterangan Tanah</option>
                        <option value="Surat Undangan Rapat" {{ old('jenis_surat')=='Surat Undangan Rapat' ? 'selected' : '' }}>Surat Undangan Rapat</option>
                    </select>
                </div>

                {{-- KETERANGAN DASAR --}}
                <div class="form-group">
                    <label for="keterangan">Keterangan / Keperluan (opsional)</label>
                    <textarea name="keterangan" id="keterangan" rows="3" class="form-control"
                        placeholder="Contoh: Untuk keperluan pengurusan KTP di Disdukcapil.">{{ old('keterangan') }}</textarea>
                </div>

                {{-- DETAIL PENGAJUAN ONLINE --}}
                <div id="section-online-wrapper" style="display:none;">

                    {{-- DOMISILI --}}
                    <div id="section-online-domisili" class="section-online-detail" style="display:none;">
                        <h3>Data Tambahan – Surat Domisili</h3>
                        <small>Lengkapi data berikut untuk pembuatan surat keterangan domisili.</small>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Pribadi</h4>

                        <div class="form-group mt-2">
                            <label for="nik">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" name="nik" id="nik" class="form-control"
                                   value="{{ old('nik') }}" placeholder="16 digit NIK pada KTP" maxlength="16" inputmode="numeric">
                        </div>
                        <div class="form-group">
                            <label for="alamat_ktp">Alamat sesuai KTP</label>
                            <textarea name="alamat_ktp" id="alamat_ktp" rows="2" class="form-control"
                                      placeholder="Alamat lengkap sesuai KTP">{{ old('alamat_ktp') }}</textarea>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Alamat Domisili</h4>

                        <div class="form-group">
                            <label for="dusun_domisili">Dusun/Desa</label>
                            <input type="text" name="dusun_domisili" id="dusun_domisili" class="form-control"
                                   value="{{ old('dusun_domisili') }}" placeholder="Nama dusun/desa tempat tinggal">
                        </div>
                        <div class="form-group">
                            <label for="rt_domisili">RT (Rukun Tetangga)</label>
                            <input type="text" name="rt_domisili" id="rt_domisili" class="form-control"
                                   value="{{ old('rt_domisili') }}" placeholder="Contoh: 001" inputmode="numeric">
                        </div>
                        <div class="form-group">
                            <label for="rw_domisili">RW (Rukun Warga)</label>
                            <input type="text" name="rw_domisili" id="rw_domisili" class="form-control"
                                   value="{{ old('rw_domisili') }}" placeholder="Contoh: 003" inputmode="numeric">
                        </div>
                        <div class="form-group">
                            <label for="alamat_domisili">Alamat Lengkap Domisili Saat Ini</label>
                            <textarea name="alamat_domisili" id="alamat_domisili" rows="2" class="form-control"
                                      placeholder="Tuliskan alamat lengkap dengan no. rumah atau landmark">{{ old('alamat_domisili') }}</textarea>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Informasi Lainnya</h4>

                        <div class="form-group">
                            <label for="tanggal_mulai_tinggal">Tanggal Mulai Tinggal</label>
                            <input type="date" name="tanggal_mulai_tinggal" id="tanggal_mulai_tinggal" class="form-control"
                                   value="{{ old('tanggal_mulai_tinggal') }}">
                        </div>
                        <div class="form-group">
                            <label for="lama_tinggal">Lama Tinggal (dalam bulan)</label>
                            <input type="number" name="lama_tinggal" id="lama_tinggal" class="form-control"
                                   value="{{ old('lama_tinggal') }}" placeholder="Contoh: 12 untuk 1 tahun" min="1">
                        </div>
                        <div class="form-group">
                            <label for="alasan_domisili">Alasan Permohonan (opsional)</label>
                            <select name="alasan_domisili" id="alasan_domisili" class="form-select">
                                <option value="">-- Pilih Alasan --</option>
                                <option value="Perizinan Usaha" {{ old('alasan_domisili')=='Perizinan Usaha' ? 'selected' : '' }}>Perizinan Usaha</option>
                                <option value="Pendidikan" {{ old('alasan_domisili')=='Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                <option value="Kesehatan" {{ old('alasan_domisili')=='Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="Keperluan Administrasi" {{ old('alasan_domisili')=='Keperluan Administrasi' ? 'selected' : '' }}>Keperluan Administrasi</option>
                                <option value="Lainnya" {{ old('alasan_domisili')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_hp_domisili">Nomor HP yang dapat dihubungi</label>
                            <input type="text" name="no_hp_domisili" id="no_hp_domisili" class="form-control"
                                   value="{{ old('no_hp_domisili') }}" placeholder="Contoh: 08xxxxxxxxxx" inputmode="numeric">
                        </div>
                    </div>

                    {{-- USAHA --}}
                    <div id="section-online-usaha" class="section-online-detail" style="display:none;">
                        <h3>Data Tambahan – Surat Keterangan Usaha</h3>
                        <small>Lengkapi data usaha Anda untuk keperluan SKU.</small>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Pemilik Usaha</h4>

                        <div class="form-group mt-2">
                            <label for="nik_usaha">NIK Pemilik</label>
                            <input type="text" name="nik_usaha" id="nik_usaha" class="form-control"
                                   value="{{ old('nik_usaha') }}" placeholder="16 digit NIK" maxlength="16" inputmode="numeric">
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Informasi Usaha</h4>

                        <div class="form-group">
                            <label for="nama_usaha">Nama Usaha</label>
                            <input type="text" name="nama_usaha" id="nama_usaha" class="form-control"
                                   value="{{ old('nama_usaha') }}" placeholder="Contoh: Warung Sembako Makmur">
                        </div>
                        <div class="form-group">
                            <label for="alamat_usaha">Alamat Usaha</label>
                            <textarea name="alamat_usaha" id="alamat_usaha" rows="2" class="form-control"
                                      placeholder="Alamat lengkap lokasi usaha (RT/RW/Dusun)">{{ old('alamat_usaha') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="jenis_usaha">Jenis Usaha</label>
                            <select name="jenis_usaha" id="jenis_usaha" class="form-select">
                                <option value="">-- Pilih Jenis Usaha --</option>
                                <option value="Warung/Toko" {{ old('jenis_usaha')=='Warung/Toko' ? 'selected' : '' }}>Warung/Toko</option>
                                <option value="Pertanian/Peternakan" {{ old('jenis_usaha')=='Pertanian/Peternakan' ? 'selected' : '' }}>Pertanian/Peternakan</option>
                                <option value="Bengkel/Reparasi" {{ old('jenis_usaha')=='Bengkel/Reparasi' ? 'selected' : '' }}>Bengkel/Reparasi</option>
                                <option value="Jasa/Layanan" {{ old('jenis_usaha')=='Jasa/Layanan' ? 'selected' : '' }}>Jasa/Layanan</option>
                                <option value="Kerajinan/Industri Rumahan" {{ old('jenis_usaha')=='Kerajinan/Industri Rumahan' ? 'selected' : '' }}>Kerajinan/Industri Rumahan</option>
                                <option value="Perdagangan" {{ old('jenis_usaha')=='Perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                                <option value="Lainnya" {{ old('jenis_usaha')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_usaha">Deskripsi Usaha (opsional)</label>
                            <textarea name="deskripsi_usaha" id="deskripsi_usaha" rows="2" class="form-control"
                                      placeholder="Jelaskan jenis produk/jasa yang ditawarkan">{{ old('deskripsi_usaha') }}</textarea>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Durasi dan Skala Usaha</h4>

                        <div class="form-group">
                            <label for="tanggal_mulai_usaha">Tanggal Mulai Usaha</label>
                            <input type="date" name="tanggal_mulai_usaha" id="tanggal_mulai_usaha" class="form-control"
                                   value="{{ old('tanggal_mulai_usaha') }}">
                        </div>
                        <div class="form-group">
                            <label for="lama_usaha">Lama Usaha Berjalan (dalam bulan)</label>
                            <input type="number" name="lama_usaha" id="lama_usaha" class="form-control"
                                   value="{{ old('lama_usaha') }}" placeholder="Contoh: 24 untuk 2 tahun" min="1">
                        </div>
                        <div class="form-group">
                            <label for="modal_usaha">Modal Awal Usaha (Rp)</label>
                            <input type="number" name="modal_usaha" id="modal_usaha" class="form-control"
                                   value="{{ old('modal_usaha') }}" placeholder="Contoh: 5000000" min="0">
                            <small style="color:#888;">Masukkan angka tanpa pemisah</small>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_karyawan">Jumlah Karyawan</label>
                            <input type="number" name="jumlah_karyawan" id="jumlah_karyawan" class="form-control"
                                   value="{{ old('jumlah_karyawan') }}" placeholder="Jumlah tenaga kerja" min="0">
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Kontak</h4>

                        <div class="form-group">
                            <label for="no_hp_usaha">Nomor HP yang dapat dihubungi</label>
                            <input type="text" name="no_hp_usaha" id="no_hp_usaha" class="form-control"
                                   value="{{ old('no_hp_usaha') }}" placeholder="Contoh: 08xxxxxxxxxx" inputmode="numeric">
                        </div>
                    </div>

                    {{-- SKTM --}}
                    <div id="section-online-sktm" class="section-online-detail" style="display:none;">
                        <h3>Data Tambahan – Surat Keterangan Tidak Mampu (SKTM)</h3>
                        <small>Lengkapi informasi keluarga Anda untuk verifikasi status ekonomi. Data ini diperlukan untuk pengajuan beasiswa, bantuan sosial, atau keperluan lainnya.</small>

                        {{-- IDENTITAS PEMOHON --}}
                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Identitas Pemohon</h4>
                        
                        <div class="form-group">
                            <label for="nik_sktm">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" name="nik_sktm" id="nik_sktm" class="form-control"
                                   value="{{ old('nik_sktm') }}" placeholder="16 digit NIK pada KTP" maxlength="16" inputmode="numeric">
                        </div>
                        <div class="form-group">
                            <label for="nama_sktm">Nama Lengkap</label>
                            <input type="text" name="nama_sktm" id="nama_sktm" class="form-control"
                                   value="{{ old('nama_sktm') }}" placeholder="Sesuai dengan KTP">
                        </div>
                        <div class="form-group">
                            <label for="no_hp_sktm">Nomor HP yang dapat dihubungi</label>
                            <input type="text" name="no_hp_sktm" id="no_hp_sktm" class="form-control"
                                   value="{{ old('no_hp_sktm') }}" placeholder="Contoh: 08xxxxxxxxxx" inputmode="numeric">
                        </div>
                        <div class="form-group">
                            <label for="alamat_sktm">Alamat Lengkap (Dusun/RT/RW)</label>
                            <textarea name="alamat_sktm" id="alamat_sktm" rows="2" class="form-control" placeholder="Tuliskan alamat lengkap beserta RT/RW">{{ old('alamat_sktm') }}</textarea>
                        </div>

                        {{-- STATUS EKONOMI --}}
                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Status Ekonomi Keluarga</h4>
                        
                        <div class="form-group">
                            <label for="status_pekerjaan">Status Pekerjaan Anda</label>
                            <select name="status_pekerjaan" id="status_pekerjaan" class="form-select">
                                <option value="">-- Pilih Status Pekerjaan --</option>
                                <option value="Tidak Bekerja" {{ old('status_pekerjaan')=='Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                <option value="Petani" {{ old('status_pekerjaan')=='Petani' ? 'selected' : '' }}>Petani</option>
                                <option value="Buruh" {{ old('status_pekerjaan')=='Buruh' ? 'selected' : '' }}>Buruh</option>
                                <option value="Pedagang" {{ old('status_pekerjaan')=='Pedagang' ? 'selected' : '' }}>Pedagang</option>
                                <option value="Karyawan Swasta" {{ old('status_pekerjaan')=='Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                <option value="PNS" {{ old('status_pekerjaan')=='PNS' ? 'selected' : '' }}>PNS</option>
                                <option value="Lainnya" {{ old('status_pekerjaan')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="penghasilan_bulanan">Penghasilan Bulanan Rata-rata (Rp)</label>
                            <input type="number" name="penghasilan_bulanan" id="penghasilan_bulanan" class="form-control"
                                   value="{{ old('penghasilan_bulanan') }}" placeholder="Contoh: 1500000" min="0">
                            <small style="color:#888;">Masukkan angka tanpa pemisah (gunakan 0 jika tidak ada penghasilan)</small>
                        </div>

                        <div class="form-group">
                            <label for="jumlah_anggota_keluarga">Jumlah Anggota Keluarga</label>
                            <input type="number" name="jumlah_anggota_keluarga" id="jumlah_anggota_keluarga" class="form-control"
                                   value="{{ old('jumlah_anggota_keluarga') }}" placeholder="Jumlah orang yang bergantung" min="1" max="20">
                        </div>

                        <div class="form-group">
                            <label for="status_rumah">Status Rumah Tinggal</label>
                            <select name="status_rumah" id="status_rumah" class="form-select">
                                <option value="">-- Pilih Status Rumah --</option>
                                <option value="Milik Sendiri" {{ old('status_rumah')=='Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                <option value="Menumpang" {{ old('status_rumah')=='Menumpang' ? 'selected' : '' }}>Menumpang</option>
                                <option value="Menyewa" {{ old('status_rumah')=='Menyewa' ? 'selected' : '' }}>Menyewa</option>
                            </select>
                        </div>

                        {{-- TUJUAN PENGAJUAN --}}
                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Tujuan Pengajuan</h4>
                        
                        <div class="form-group">
                            <label for="tujuan_sktm">Untuk Keperluan Apa?</label>
                            <select name="tujuan_sktm" id="tujuan_sktm" class="form-select">
                                <option value="">-- Pilih Tujuan --</option>
                                <option value="Beasiswa Pendidikan" {{ old('tujuan_sktm')=='Beasiswa Pendidikan' ? 'selected' : '' }}>Beasiswa Pendidikan</option>
                                <option value="Bantuan Kesehatan" {{ old('tujuan_sktm')=='Bantuan Kesehatan' ? 'selected' : '' }}>Bantuan Kesehatan</option>
                                <option value="Bantuan Sosial" {{ old('tujuan_sktm')=='Bantuan Sosial' ? 'selected' : '' }}>Bantuan Sosial</option>
                                <option value="Kredit/Pinjaman" {{ old('tujuan_sktm')=='Kredit/Pinjaman' ? 'selected' : '' }}>Kredit/Pinjaman</option>
                                <option value="Asuransi Kesehatan" {{ old('tujuan_sktm')=='Asuransi Kesehatan' ? 'selected' : '' }}>Asuransi Kesehatan</option>
                                <option value="Lainnya" {{ old('tujuan_sktm')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="instansi_sktm">Nama Instansi/Lembaga Tujuan</label>
                            <input type="text" name="instansi_sktm" id="instansi_sktm" class="form-control"
                                   value="{{ old('instansi_sktm') }}" placeholder="Contoh: SMPN 1, Rumah Sakit Umum, BRI, dll.">
                        </div>

                        <div class="form-group">
                            <label for="keterangan_tambahan_sktm">Keterangan Tambahan (opsional)</label>
                            <textarea name="keterangan_tambahan_sktm" id="keterangan_tambahan_sktm" rows="2" class="form-control"
                                      placeholder="Informasi lainnya yang ingin Anda sampaikan...">{{ old('keterangan_tambahan_sktm') }}</textarea>
                        </div>
                    </div>

                    {{-- PENGANTAR KTP --}}
                    <div id="section-online-ktp" class="section-online-detail" style="display:none;">
                        <h3>Data Tambahan – Surat Pengantar KTP</h3>
                        <small>Data ini akan digunakan untuk pembuatan/penggantian KTP di Disdukcapil.</small>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Pribadi</h4>

                        <div class="form-group mt-2">
                            <label for="nik_ktp">NIK <span style="color:red;">*</span></label>
                            <input type="text" name="nik_ktp" id="nik_ktp" class="form-control"
                                   value="{{ old('nik_ktp') }}" placeholder="16 digit NIK" maxlength="16" inputmode="numeric" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_ktp">Nama Lengkap</label>
                            <input type="text" name="nama_ktp" id="nama_ktp" class="form-control"
                                   value="{{ old('nama_ktp') }}" placeholder="Sesuai kartu keluarga">
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_ktp">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir_ktp" id="tempat_lahir_ktp" class="form-control"
                                   value="{{ old('tempat_lahir_ktp') }}" placeholder="Nama kota/kabupaten">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_ktp">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir_ktp" id="tanggal_lahir_ktp" class="form-control"
                                   value="{{ old('tanggal_lahir_ktp') }}">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin_ktp">Jenis Kelamin</label>
                            <select name="jenis_kelamin_ktp" id="jenis_kelamin_ktp" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin_ktp')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin_ktp')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama_ktp">Agama</label>
                            <select name="agama_ktp" id="agama_ktp" class="form-select">
                                <option value="">-- Pilih Agama --</option>
                                <option value="Islam" {{ old('agama_ktp')=='Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama_ktp')=='Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama_ktp')=='Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama_ktp')=='Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama_ktp')=='Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama_ktp')=='Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_ktp">Pekerjaan</label>
                            <input type="text" name="pekerjaan_ktp" id="pekerjaan_ktp" class="form-control"
                                   value="{{ old('pekerjaan_ktp') }}" placeholder="Contoh: Petani, Karyawan, dll.">
                        </div>
                        <div class="form-group">
                            <label for="status_perkawinan_ktp">Status Perkawinan</label>
                            <select name="status_perkawinan_ktp" id="status_perkawinan_ktp" class="form-select">
                                <option value="">-- Pilih Status --</option>
                                <option value="Belum Kawin" {{ old('status_perkawinan_ktp')=='Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_perkawinan_ktp')=='Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Cerai Hidup" {{ old('status_perkawinan_ktp')=='Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ old('status_perkawinan_ktp')=='Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat_ktp_ktp">Alamat Sesuai KTP</label>
                            <textarea name="alamat_ktp_ktp" id="alamat_ktp_ktp" rows="2" class="form-control"
                                      placeholder="Alamat lengkap dengan RT/RW">{{ old('alamat_ktp_ktp') }}</textarea>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Jenis Permohonan</h4>

                        <div class="form-group">
                            <label for="jenis_permohonan">Jenis Permohonan</label>
                            <select name="jenis_permohonan" id="jenis_permohonan" class="form-select">
                                <option value="">-- Pilih Jenis Permohonan --</option>
                                <option value="Baru" {{ old('jenis_permohonan')=='Baru' ? 'selected' : '' }}>KTP Baru (belum pernah punya)</option>
                                <option value="Perubahan Data" {{ old('jenis_permohonan')=='Perubahan Data' ? 'selected' : '' }}>Perubahan Data (nama/status/pekerjaan)</option>
                                <option value="Hilang" {{ old('jenis_permohonan')=='Hilang' ? 'selected' : '' }}>KTP Hilang</option>
                                <option value="Rusak" {{ old('jenis_permohonan')=='Rusak' ? 'selected' : '' }}>KTP Rusak</option>
                                <option value="Perpanjangan" {{ old('jenis_permohonan')=='Perpanjangan' ? 'selected' : '' }}>Perpanjangan KTP</option>
                            </select>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Keterangan Permohonan</h4>

                        <div class="form-group">
                            <label for="alasan_permohonan">Alasan/Deskripsi Permohonan</label>
                            <textarea name="alasan_permohonan" id="alasan_permohonan" rows="2" class="form-control"
                                      placeholder="Jelaskan alasan permohonan Anda secara detail">{{ old('alasan_permohonan') }}</textarea>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Kontak</h4>

                        <div class="form-group">
                            <label for="no_hp_ktp">Nomor HP yang dapat dihubungi</label>
                            <input type="text" name="no_hp_ktp" id="no_hp_ktp" class="form-control"
                                   value="{{ old('no_hp_ktp') }}" placeholder="Contoh: 08xxxxxxxxxx" inputmode="numeric">
                        </div>
                    </div>

                    {{-- KELAHIRAN --}}
                    <div id="section-online-kelahiran" class="section-online-detail" style="display:none;">
                        <h3>Data Tambahan – Surat Kelahiran</h3>
                        <small>Data bayi yang akan didaftarkan di Dinas Kependudukan dan Pencatatan Sipil.</small>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Bayi</h4>

                        <div class="form-group mt-2">
                            <label for="nama_bayi">Nama Bayi</label>
                            <input type="text" name="nama_bayi" id="nama_bayi" class="form-control"
                                   value="{{ old('nama_bayi') }}" placeholder="Nama lengkap bayi">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin_bayi">Jenis Kelamin Bayi</label>
                            <select name="jenis_kelamin_bayi" id="jenis_kelamin_bayi" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin_bayi')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin_bayi')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_bayi">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir_bayi" id="tempat_lahir_bayi" class="form-control"
                                   value="{{ old('tempat_lahir_bayi') }}" placeholder="Contoh: Rumah, Puskesmas, Rumah Sakit">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_bayi">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir_bayi" id="tanggal_lahir_bayi" class="form-control date-input"
                                   value="{{ old('tanggal_lahir_bayi') }}">
                        </div>
                        <div class="form-group">
                            <label for="berat_bayi">Berat Bayi (gram)</label>
                            <input type="number" name="berat_bayi" id="berat_bayi" class="form-control"
                                   value="{{ old('berat_bayi') }}" placeholder="Contoh: 3500" min="500" max="5000">
                        </div>
                        <div class="form-group">
                            <label for="panjang_bayi">Panjang Bayi (cm)</label>
                            <input type="number" name="panjang_bayi" id="panjang_bayi" class="form-control" step="0.1"
                                   value="{{ old('panjang_bayi') }}" placeholder="Contoh: 50" min="30" max="60">
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Orang Tua</h4>

                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control"
                                   value="{{ old('nama_ayah') }}" placeholder="Nama lengkap ayah">
                        </div>
                        <div class="form-group">
                            <label for="nik_ayah">NIK Ayah <span style="color:red;">*</span></label>
                            <input type="text" name="nik_ayah" id="nik_ayah" class="form-control"
                                   value="{{ old('nik_ayah') }}" placeholder="16 digit NIK" maxlength="16" inputmode="numeric" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control"
                                   value="{{ old('nama_ibu') }}" placeholder="Nama lengkap ibu">
                        </div>
                        <div class="form-group">
                            <label for="nik_ibu">NIK Ibu <span style="color:red;">*</span></label>
                            <input type="text" name="nik_ibu" id="nik_ibu" class="form-control"
                                   value="{{ old('nik_ibu') }}" placeholder="16 digit NIK" maxlength="16" inputmode="numeric" required>
                        </div>
                        <div class="form-group">
                            <label for="no_kk_kelahiran">Nomor Kartu Keluarga <span style="color:red;">*</span></label>
                            <input type="text" name="no_kk_kelahiran" id="no_kk_kelahiran" class="form-control"
                                   value="{{ old('no_kk_kelahiran') }}" placeholder="16 digit No KK" maxlength="16" inputmode="numeric" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_orangtua">Alamat Orang Tua</label>
                            <textarea name="alamat_orangtua" id="alamat_orangtua" rows="2" class="form-control"
                                      placeholder="Alamat lengkap dengan RT/RW">{{ old('alamat_orangtua') }}</textarea>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Lampiran Dokumen</h4>

                        <div class="form-group">
                            <label for="lampiran_kelahiran">Lampiran Dokumen Pendukung <span style="color:red;">*</span></label>
                            <input type="file" name="lampiran_kelahiran" id="lampiran_kelahiran" class="form-control" required>
                            <small style="color:#888;">Upload dokumen pendukung (surat bersalin, buku kesehatan ibu-anak, dll.). Format: PDF, JPG, PNG. Max: 5MB</small>
                        </div>
                    </div>

                    {{-- KEMATIAN --}}
                    <div id="section-online-kematian" class="section-online-detail" style="display:none;">
                        <h3>Data Tambahan – Surat Kematian</h3>
                        <small>Data untuk pembuatan surat keterangan kematian yang akan didaftarkan di Dinas Kependudukan.</small>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Almarhum/Almarhumah</h4>

                        <div class="form-group mt-2">
                            <label for="nama_almarhum">Nama Lengkap Almarhum/Almarhumah</label>
                            <input type="text" name="nama_almarhum" id="nama_almarhum" class="form-control"
                                   value="{{ old('nama_almarhum') }}" placeholder="Nama lengkap sesuai KTP">
                        </div>
                        <div class="form-group">
                            <label for="nik_almarhum">NIK Almarhum/Almarhumah</label>
                            <input type="text" name="nik_almarhum" id="nik_almarhum" class="form-control"
                                   value="{{ old('nik_almarhum') }}" placeholder="16 digit NIK" maxlength="16" inputmode="numeric">
                        </div>
                        <div class="form-group">
                            <label for="umur_almarhum">Usia Saat Meninggal (tahun)</label>
                            <input type="number" name="umur_almarhum" id="umur_almarhum" class="form-control"
                                   value="{{ old('umur_almarhum') }}" min="0" max="150">
                        </div>
                        <div class="form-group">
                            <label for="alamat_almarhum">Alamat Terakhir Almarhum/Almarhumah</label>
                            <textarea name="alamat_almarhum" id="alamat_almarhum" rows="2" class="form-control"
                                      placeholder="Alamat lengkap dengan RT/RW">{{ old('alamat_almarhum') }}</textarea>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Kematian</h4>

                        <div class="form-group">
                            <label for="tanggal_meninggal">Tanggal Meninggal</label>
                            <input type="date" name="tanggal_meninggal" id="tanggal_meninggal" class="form-control date-input"
                                   value="{{ old('tanggal_meninggal') }}">
                        </div>
                        <div class="form-group">
                            <label for="tempat_meninggal">Tempat Meninggal</label>
                            <select name="tempat_meninggal" id="tempat_meninggal" class="form-select">
                                <option value="">-- Pilih Tempat --</option>
                                <option value="Rumah" {{ old('tempat_meninggal')=='Rumah' ? 'selected' : '' }}>Rumah</option>
                                <option value="Rumah Sakit" {{ old('tempat_meninggal')=='Rumah Sakit' ? 'selected' : '' }}>Rumah Sakit</option>
                                <option value="Puskesmas" {{ old('tempat_meninggal')=='Puskesmas' ? 'selected' : '' }}>Puskesmas</option>
                                <option value="Jalan/Tempat Umum" {{ old('tempat_meninggal')=='Jalan/Tempat Umum' ? 'selected' : '' }}>Jalan/Tempat Umum</option>
                                <option value="Lainnya" {{ old('tempat_meninggal')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sebab_meninggal">Sebab Meninggal (opsional)</label>
                            <textarea name="sebab_meninggal" id="sebab_meninggal" rows="2" class="form-control"
                                      placeholder="Penyakit atau penyebab kematian">{{ old('sebab_meninggal') }}</textarea>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Pemohon</h4>

                        <div class="form-group">
                            <label for="hubungan_pemohon">Hubungan Pemohon dengan Almarhum</label>
                            <select name="hubungan_pemohon" id="hubungan_pemohon" class="form-select">
                                <option value="">-- Pilih Hubungan --</option>
                                <option value="Anak" {{ old('hubungan_pemohon')=='Anak' ? 'selected' : '' }}>Anak</option>
                                <option value="Istri" {{ old('hubungan_pemohon')=='Istri' ? 'selected' : '' }}>Istri</option>
                                <option value="Suami" {{ old('hubungan_pemohon')=='Suami' ? 'selected' : '' }}>Suami</option>
                                <option value="Orang Tua" {{ old('hubungan_pemohon')=='Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                <option value="Saudara" {{ old('hubungan_pemohon')=='Saudara' ? 'selected' : '' }}>Saudara</option>
                                <option value="Lainnya" {{ old('hubungan_pemohon')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    {{-- PENGANTAR KUA --}}
                    <div id="section-online-kua" class="section-online-detail" style="display:none;">
                        <h3>Data Tambahan – Surat Pengantar KUA</h3>
                        <small>Lengkapi data calon pengantin dan rencana pernikahan untuk proses di Kantor Urusan Agama.</small>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Calon Suami</h4>

                        <div class="form-group mt-2">
                            <label for="nama_calon_suami">Nama Calon Suami</label>
                            <input type="text" name="nama_calon_suami" id="nama_calon_suami" class="form-control"
                                   value="{{ old('nama_calon_suami') }}" placeholder="Nama lengkap">
                        </div>
                        <div class="form-group">
                            <label for="nik_calon_suami">NIK Calon Suami</label>
                            <input type="text" name="nik_calon_suami" id="nik_calon_suami" class="form-control"
                                   value="{{ old('nik_calon_suami') }}" placeholder="16 digit NIK" maxlength="16" inputmode="numeric">
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_suami">Tempat/Tanggal Lahir (opsional)</label>
                            <input type="text" name="tempat_lahir_suami" id="tempat_lahir_suami" class="form-control"
                                   value="{{ old('tempat_lahir_suami') }}" placeholder="Contoh: Jakarta, 15-01-1995">
                        </div>
                        <div class="form-group">
                            <label for="alamat_calon_suami">Alamat</label>
                            <textarea name="alamat_calon_suami" id="alamat_calon_suami" rows="2" class="form-control"
                                      placeholder="Alamat lengkap dengan RT/RW">{{ old('alamat_calon_suami') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_suami">Pekerjaan Calon Suami</label>
                            <input type="text" name="pekerjaan_suami" id="pekerjaan_suami" class="form-control"
                                   value="{{ old('pekerjaan_suami') }}" placeholder="Contoh: Petani, Karyawan, dll.">
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Calon Istri</h4>

                        <div class="form-group">
                            <label for="nama_calon_istri">Nama Calon Istri</label>
                            <input type="text" name="nama_calon_istri" id="nama_calon_istri" class="form-control"
                                   value="{{ old('nama_calon_istri') }}" placeholder="Nama lengkap">
                        </div>
                        <div class="form-group">
                            <label for="nik_calon_istri">NIK Calon Istri</label>
                            <input type="text" name="nik_calon_istri" id="nik_calon_istri" class="form-control"
                                   value="{{ old('nik_calon_istri') }}" placeholder="16 digit NIK" maxlength="16" inputmode="numeric">
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_istri">Tempat/Tanggal Lahir (opsional)</label>
                            <input type="text" name="tempat_lahir_istri" id="tempat_lahir_istri" class="form-control"
                                   value="{{ old('tempat_lahir_istri') }}" placeholder="Contoh: Bandung, 10-05-1997">
                        </div>
                        <div class="form-group">
                            <label for="alamat_calon_istri">Alamat</label>
                            <textarea name="alamat_calon_istri" id="alamat_calon_istri" rows="2" class="form-control"
                                      placeholder="Alamat lengkap dengan RT/RW">{{ old('alamat_calon_istri') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_istri">Pekerjaan Calon Istri</label>
                            <input type="text" name="pekerjaan_istri" id="pekerjaan_istri" class="form-control"
                                   value="{{ old('pekerjaan_istri') }}" placeholder="Contoh: Ibu Rumah Tangga, Guru, dll.">
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Rencana Pernikahan</h4>

                        <div class="form-group">
                            <label for="tanggal_nikah">Rencana Tanggal Nikah</label>
                            <input type="date" name="tanggal_nikah" id="tanggal_nikah" class="form-control date-input"
                                   value="{{ old('tanggal_nikah') }}">
                        </div>
                        <div class="form-group">
                            <label for="tempat_nikah">Tempat Akad Nikah</label>
                            <select name="tempat_nikah" id="tempat_nikah" class="form-select">
                                <option value="">-- Pilih Tempat --</option>
                                <option value="KUA" {{ old('tempat_nikah')=='KUA' ? 'selected' : '' }}>Kantor Urusan Agama (KUA)</option>
                                <option value="Rumah" {{ old('tempat_nikah')=='Rumah' ? 'selected' : '' }}>Rumah</option>
                                <option value="Masjid" {{ old('tempat_nikah')=='Masjid' ? 'selected' : '' }}>Masjid</option>
                                <option value="Gedung" {{ old('tempat_nikah')=='Gedung' ? 'selected' : '' }}>Gedung/Aula</option>
                                <option value="Lainnya" {{ old('tempat_nikah')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    {{-- BELUM MENIKAH --}}
                    <div id="section-online-belum-menikah" class="section-online-detail" style="display:none;">
                        <h3>Data Tambahan – Surat Keterangan Belum Menikah</h3>
                        <small>Digunakan untuk keperluan pekerjaan, kuliah, atau keperluan resmi lainnya yang membutuhkan bukti status belum menikah.</small>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Pribadi</h4>

                        <div class="form-group mt-2">
                            <label for="nik_belum_menikah">NIK</label>
                            <input type="text" name="nik_belum_menikah" id="nik_belum_menikah" class="form-control"
                                   value="{{ old('nik_belum_menikah') }}" placeholder="16 digit NIK" maxlength="16" inputmode="numeric">
                        </div>
                        <div class="form-group">
                            <label for="nama_belum_menikah">Nama Lengkap</label>
                            <input type="text" name="nama_belum_menikah" id="nama_belum_menikah" class="form-control"
                                   value="{{ old('nama_belum_menikah') }}" placeholder="Sesuai KTP">
                        </div>
                        <div class="form-group">
                            <label for="alamat_belum_menikah">Alamat</label>
                            <textarea name="alamat_belum_menikah" id="alamat_belum_menikah" rows="2" class="form-control"
                                      placeholder="Alamat lengkap dengan RT/RW">{{ old('alamat_belum_menikah') }}</textarea>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Tujuan Pengajuan</h4>

                        <div class="form-group">
                            <label for="tujuan_belum_menikah">Untuk Keperluan Apa?</label>
                            <select name="tujuan_belum_menikah" id="tujuan_belum_menikah" class="form-select">
                                <option value="">-- Pilih Tujuan --</option>
                                <option value="Melamar Pekerjaan" {{ old('tujuan_belum_menikah')=='Melamar Pekerjaan' ? 'selected' : '' }}>Melamar Pekerjaan</option>
                                <option value="Pendidikan/Kuliah" {{ old('tujuan_belum_menikah')=='Pendidikan/Kuliah' ? 'selected' : '' }}>Pendidikan/Kuliah</option>
                                <option value="Izin Visa" {{ old('tujuan_belum_menikah')=='Izin Visa' ? 'selected' : '' }}>Izin Visa</option>
                                <option value="Permohonan Kredit" {{ old('tujuan_belum_menikah')=='Permohonan Kredit' ? 'selected' : '' }}>Permohonan Kredit</option>
                                <option value="Lainnya" {{ old('tujuan_belum_menikah')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="instansi_belum_menikah">Nama Instansi/Lembaga Tujuan</label>
                            <input type="text" name="instansi_belum_menikah" id="instansi_belum_menikah" class="form-control"
                                   value="{{ old('instansi_belum_menikah') }}" placeholder="Contoh: PT Maju Jaya, STIS Jakarta, dll.">
                        </div>
                    </div>

                    {{-- KETERANGAN TANAH --}}
                    <div id="section-online-tanah" class="section-online-detail" style="display:none;">
                        <h3>Data Tambahan – Surat Keterangan Tanah</h3>
                        <small>Data ini akan digunakan untuk keterangan kepemilikan dan kondisi tanah (perlu data akurat untuk verifikasi).</small>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Data Tanah</h4>

                        <div class="form-group mt-2">
                            <label for="lokasi_tanah">Lokasi Tanah</label>
                            <textarea name="lokasi_tanah" id="lokasi_tanah" rows="2" class="form-control"
                                      placeholder="Alamat lengkap lokasi tanah (Dusun/RT/RW)">{{ old('lokasi_tanah') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="luas_tanah">Luas Tanah (m²)</label>
                            <input type="number" name="luas_tanah" id="luas_tanah" class="form-control"
                                   value="{{ old('luas_tanah') }}" placeholder="Contoh: 200" step="0.01" min="1">
                        </div>
                        <div class="form-group">
                            <label for="peruntukan">Peruntukan Tanah</label>
                            <select name="peruntukan" id="peruntukan" class="form-select">
                                <option value="">-- Pilih Peruntukan --</option>
                                <option value="Sawah" {{ old('peruntukan')=='Sawah' ? 'selected' : '' }}>Sawah</option>
                                <option value="Tegalan/Kebun" {{ old('peruntukan')=='Tegalan/Kebun' ? 'selected' : '' }}>Tegalan/Kebun</option>
                                <option value="Pekarangan/Rumah" {{ old('peruntukan')=='Pekarangan/Rumah' ? 'selected' : '' }}>Pekarangan/Rumah</option>
                                <option value="Kolam/Tambak" {{ old('peruntukan')=='Kolam/Tambak' ? 'selected' : '' }}>Kolam/Tambak</option>
                                <option value="Usaha/Komersial" {{ old('peruntukan')=='Usaha/Komersial' ? 'selected' : '' }}>Usaha/Komersial</option>
                                <option value="Lainnya" {{ old('peruntukan')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Batas-Batas Tanah</h4>

                        <div class="form-group">
                            <label for="batas_utara">Batas Utara</label>
                            <input type="text" name="batas_utara" id="batas_utara" class="form-control"
                                   value="{{ old('batas_utara') }}" placeholder="Nama pemilik/jalan/sungai">
                        </div>
                        <div class="form-group">
                            <label for="batas_selatan">Batas Selatan</label>
                            <input type="text" name="batas_selatan" id="batas_selatan" class="form-control"
                                   value="{{ old('batas_selatan') }}" placeholder="Nama pemilik/jalan/sungai">
                        </div>
                        <div class="form-group">
                            <label for="batas_timur">Batas Timur</label>
                            <input type="text" name="batas_timur" id="batas_timur" class="form-control"
                                   value="{{ old('batas_timur') }}" placeholder="Nama pemilik/jalan/sungai">
                        </div>
                        <div class="form-group">
                            <label for="batas_barat">Batas Barat</label>
                            <input type="text" name="batas_barat" id="batas_barat" class="form-control"
                                   value="{{ old('batas_barat') }}" placeholder="Nama pemilik/jalan/sungai">
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Status Kepemilikan</h4>

                        <div class="form-group">
                            <label for="status_tanah">Status Kepemilikan Tanah</label>
                            <select name="status_tanah" id="status_tanah" class="form-select">
                                <option value="">-- Pilih Status --</option>
                                <option value="Milik Sendiri" {{ old('status_tanah')=='Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                <option value="Warisan" {{ old('status_tanah')=='Warisan' ? 'selected' : '' }}>Warisan</option>
                                <option value="Hibah" {{ old('status_tanah')=='Hibah' ? 'selected' : '' }}>Hibah</option>
                                <option value="Sewa" {{ old('status_tanah')=='Sewa' ? 'selected' : '' }}>Sewa</option>
                                <option value="Lainnya" {{ old('status_tanah')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    {{-- UNDANGAN RAPAT --}}
                    <div id="section-online-rapat" class="section-online-detail" style="display:none;">
                        <h3>Data Tambahan – Surat Undangan Rapat</h3>
                        <small>Data ini digunakan untuk menyusun surat undangan rapat resmi desa.</small>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Informasi Rapat</h4>

                        <div class="form-group mt-2">
                            <label for="tipe_rapat">Tipe/Jenis Rapat</label>
                            <select name="tipe_rapat" id="tipe_rapat" class="form-select">
                                <option value="">-- Pilih Tipe Rapat --</option>
                                <option value="Musyawarah Desa" {{ old('tipe_rapat')=='Musyawarah Desa' ? 'selected' : '' }}>Musyawarah Desa</option>
                                <option value="Rapat Koordinasi" {{ old('tipe_rapat')=='Rapat Koordinasi' ? 'selected' : '' }}>Rapat Koordinasi</option>
                                <option value="Rapat Pembangunan" {{ old('tipe_rapat')=='Rapat Pembangunan' ? 'selected' : '' }}>Rapat Pembangunan</option>
                                <option value="Rapat Evaluasi" {{ old('tipe_rapat')=='Rapat Evaluasi' ? 'selected' : '' }}>Rapat Evaluasi</option>
                                <option value="Rapat Kerja" {{ old('tipe_rapat')=='Rapat Kerja' ? 'selected' : '' }}>Rapat Kerja</option>
                                <option value="Pertemuan Umum" {{ old('tipe_rapat')=='Pertemuan Umum' ? 'selected' : '' }}>Pertemuan Umum</option>
                                <option value="Lainnya" {{ old('tipe_rapat')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="judul_rapat">Judul / Nama Rapat</label>
                            <input type="text" name="judul_rapat" id="judul_rapat" class="form-control"
                                   value="{{ old('judul_rapat') }}" placeholder="Contoh: Rapat Musyawarah Pembangunan Desa Tahun 2025">
                        </div>
                        <div class="form-group">
                            <label for="agenda_rapat">Agenda Rapat</label>
                            <textarea name="agenda_rapat" id="agenda_rapat" rows="3" class="form-control"
                                      placeholder="Uraikan agenda rapat secara detail (pisahkan dengan nomor jika ada beberapa agenda)">{{ old('agenda_rapat') }}</textarea>
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Jadwal dan Tempat</h4>

                        <div class="form-group">
                            <label for="tanggal_rapat">Tanggal Rapat</label>
                            <input type="date" name="tanggal_rapat" id="tanggal_rapat" class="form-control date-input"
                                   value="{{ old('tanggal_rapat') }}">
                        </div>
                        <div class="form-group">
                            <label for="waktu_rapat">Waktu Rapat</label>
                            <input type="time" name="waktu_rapat" id="waktu_rapat" class="form-control"
                                   value="{{ old('waktu_rapat') }}">
                        </div>
                        <div class="form-group">
                            <label for="tempat_rapat">Tempat Rapat</label>
                            <input type="text" name="tempat_rapat" id="tempat_rapat" class="form-control"
                                   value="{{ old('tempat_rapat') }}" placeholder="Contoh: Balai Desa, Aula Desa, Rumah Kepala Desa, dll.">
                        </div>

                        <h4 style="margin-top:15px; margin-bottom:10px; color:#1b5e20; font-weight:600;">Peserta dan Penanggung Jawab</h4>

                        <div class="form-group">
                            <label for="penerima_undangan">Penerima Undangan</label>
                            <textarea name="penerima_undangan" id="penerima_undangan" rows="2" class="form-control"
                                      placeholder="Contoh: Ketua RT/RW, tokoh masyarakat, warga RT 01, dsb. (pisahkan dengan koma)">{{ old('penerima_undangan') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="penanggung_jawab">Penanggung Jawab Rapat</label>
                            <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control"
                                   value="{{ old('penanggung_jawab') }}" placeholder="Contoh: Kepala Desa, Ketua Panitia, dll.">
                        </div>
                        <div class="form-group">
                            <label for="catatan_rapat">Catatan Khusus (opsional)</label>
                            <textarea name="catatan_rapat" id="catatan_rapat" rows="2" class="form-control"
                                      placeholder="Keterangan tambahan tentang rapat">{{ old('catatan_rapat') }}</textarea>
                        </div>
                    </div>

                </div> {{-- /section-online-wrapper --}}

                <button type="submit" class="btn-primary">
                    Ajukan Surat
                </button>
            </form>
        </div>

        {{-- INFO / KONTEN SAMPING --}}
        <div class="card">
            <h2 class="card-title">Informasi Layanan</h2>
            <p class="text-muted">
                • Pengajuan surat akan diproses oleh perangkat desa pada hari kerja.<br>
                • Pastikan semua data yang Anda isi sudah benar dan lengkap.<br>
                • Silakan datang ke kantor desa untuk mengambil dokumen ketika status sudah <strong>disetujui</strong>.<br>
                • Bawa berkas pendukung asli (KTP, KK, dan dokumen lain yang diperlukan sesuai jenis surat).
            </p>
        </div>
    </div>

    {{-- STATUS PENGAJUAN --}}
    <div class="card" style="margin-top: 25px;">
        <h2 class="card-title">Riwayat Pengajuan Surat Anda</h2>

        <div class="table-wrapper">
        <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Jenis Surat</th>
            <th>Tanggal Pengajuan</th>
            <th>Estimasi Selesai</th>
            <th>Status</th>
            <th>Catatan Admin</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($surat as $index => $item)
            @php
                $status = $item->status ?? 'menunggu';
                $badgeClass = match ($status) {
                    'disetujui' => 'badge-disetujui',
                    'ditolak'   => 'badge-ditolak',
                    default     => 'badge-menunggu',
                };
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->jenis_surat }}</td>
                <td>{{ $item->created_at?->format('d-m-Y') ?? '-' }}</td>

                {{-- Estimasi selesai --}}
                <td>
                    @if($item->estimasi_selesai)
                        {{ $item->estimasi_selesai->format('d-m-Y H:i') }}
                    @elseif($status === 'disetujui')
                        <span class="text-muted">Belum ditentukan</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>

                <td>
                    <span class="badge {{ $badgeClass }}">
                        {{ ucfirst($status) }}
                    </span>
                </td>
                <td>
                    @if($item->catatan_admin)
                        <div class="catatan-admin-link">
                            📌 Ada catatan
                            <span class="catatan-admin-tooltip">{{ $item->catatan_admin }}</span>
                        </div>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>{{ $item->keterangan ?: '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-muted">
                    Belum ada pengajuan surat. Silakan isi form di atas untuk mengajukan surat pertama Anda.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectJenis = document.getElementById('jenis_surat');

        const wrapperOnline     = document.getElementById('section-online-wrapper');
        const sectionDomisili   = document.getElementById('section-online-domisili');
        const sectionUsaha      = document.getElementById('section-online-usaha');
        const sectionSKTM       = document.getElementById('section-online-sktm');
        const sectionKTP        = document.getElementById('section-online-ktp');
        const sectionKelahiran  = document.getElementById('section-online-kelahiran');
        const sectionKematian   = document.getElementById('section-online-kematian');
        const sectionKUA        = document.getElementById('section-online-kua');
        const sectionBelumMenikah = document.getElementById('section-online-belum-menikah');
        const sectionTanah      = document.getElementById('section-online-tanah');
        const sectionRapat      = document.getElementById('section-online-rapat');

        const lampiranWrapper   = document.getElementById('section-lampiran-wrapper');
        const lampiranHint      = document.getElementById('lampiran_hint');

        function hideAllSections() {
            sectionDomisili.style.display     = 'none';
            sectionUsaha.style.display        = 'none';
            sectionSKTM.style.display         = 'none';
            sectionKTP.style.display          = 'none';
            sectionKelahiran.style.display    = 'none';
            sectionKematian.style.display     = 'none';
            sectionKUA.style.display          = 'none';
            sectionBelumMenikah.style.display = 'none';
            sectionTanah.style.display        = 'none';
            sectionRapat.style.display        = 'none';
        }

        function updateOnlineSection() {
            const jenis = selectJenis ? selectJenis.value : '';

            wrapperOnline.style.display = 'none';
            hideAllSections();

            if (lampiranWrapper) {
                lampiranWrapper.style.display = 'none';
            }

            if (!jenis) {
                return;
            }

            wrapperOnline.style.display = 'block';

            switch (jenis) {
                case 'Surat Domisili':
                    sectionDomisili.style.display = 'block';
                    break;
                case 'Surat Keterangan Usaha':
                    sectionUsaha.style.display = 'block';
                    break;
                case 'Surat Keterangan Tidak Mampu':
                    sectionSKTM.style.display = 'block';
                    break;
                case 'Surat Pengantar KTP':
                    sectionKTP.style.display = 'block';
                    break;
                case 'Surat Kelahiran':
                    sectionKelahiran.style.display = 'block';
                    break;
                case 'Surat Kematian':
                    sectionKematian.style.display = 'block';
                    break;
                case 'Surat Pengantar KUA':
                    sectionKUA.style.display = 'block';
                    break;
                case 'Surat Keterangan Belum Menikah':
                    sectionBelumMenikah.style.display = 'block';
                    break;
                case 'Surat Keterangan Tanah':
                    sectionTanah.style.display = 'block';
                    break;
                case 'Surat Undangan Rapat':
                    sectionRapat.style.display = 'block';
                    break;
            }

            // Tampilkan lampiran untuk jenis tertentu dengan hint sesuai
            if (lampiranWrapper && lampiranHint) {
                let hintText = null;

                switch (jenis) {
                    case 'Surat Pengantar KTP':
                        hintText = 'Disarankan mengunggah surat keterangan hilang dari kepolisian (jika KTP hilang) atau dokumen pendukung lain.';
                        break;
                    case 'Surat Keterangan Tidak Mampu':
                        hintText = 'Bisa mengunggah surat pengantar RT/RW atau surat pernyataan tidak mampu (opsional).';
                        break;
                    case 'Surat Kelahiran':
                        hintText = 'Disarankan mengunggah surat keterangan lahir dari bidan/rumah sakit (opsional).';
                        break;
                    case 'Surat Kematian':
                        hintText = 'Disarankan mengunggah surat keterangan kematian dari dokter/puskesmas (jika ada).';
                        break;
                    case 'Surat Pengantar KUA':
                        hintText = 'Bisa mengunggah fotokopi KTP/KK atau dokumen pendukung lainnya (opsional).';
                        break;
                    case 'Surat Keterangan Tanah':
                        hintText = 'Bisa mengunggah bukti kepemilikan tanah atau bukti pembayaran PBB terakhir (opsional).';
                        break;
                    default:
                        hintText = null;
                }

                if (hintText) {
                    lampiranWrapper.style.display = 'block';
                    lampiranHint.textContent = hintText;
                }
            }
        }

        if (selectJenis) {
            selectJenis.addEventListener('change', updateOnlineSection);

            // panggil sekali di awal untuk handle old() / reload
            updateOnlineSection();
        }

        // Validasi tanggal - pastikan minimal tanggal hari ini
        const dateInputs = document.querySelectorAll('.date-input');
        const today = new Date().toISOString().split('T')[0];

        dateInputs.forEach(input => {
            // Set min date ke hari ini
            input.setAttribute('min', today);

            // Tambahkan event listener untuk validasi real-time
            input.addEventListener('change', function() {
                if (this.value && this.value < today) {
                    this.value = '';
                    alert('Tanggal tidak boleh sebelum hari ini. Silakan pilih tanggal hari ini atau setelahnya.');
                }
            });

            // Validasi saat blur (kehilangan fokus)
            input.addEventListener('blur', function() {
                if (this.value && this.value < today) {
                    this.classList.add('is-invalid');
                    this.style.borderColor = '#dc3545';
                } else {
                    this.classList.remove('is-invalid');
                    this.style.borderColor = '';
                }
            });
        });

        // Validasi form sebelum submit
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                let isValid = true;
                let errorMessages = [];

                // Validasi tanggal
                dateInputs.forEach(input => {
                    if (input.value && input.value < today) {
                        isValid = false;
                        input.classList.add('is-invalid');
                        input.style.borderColor = '#dc3545';
                    }
                });

                // Validasi field required berdasarkan jenis surat
                const jenisSuratValue = document.querySelector('select[name="jenis_surat"]')?.value;
                const requiredFields = getRequiredFieldsForSurat(jenisSuratValue);

                requiredFields.forEach(fieldName => {
                    const field = document.querySelector(`[name="${fieldName}"]`);
                    if (field && field.parentElement.style.display !== 'none') {
                        if (!field.value || field.value.trim() === '') {
                            isValid = false;
                            field.classList.add('is-invalid');
                            field.style.borderColor = '#dc3545';
                            const label = field.previousElementSibling || 
                                        document.querySelector(`label[for="${fieldName}"]`);
                            if (label) {
                                errorMessages.push(`${label.textContent.trim().replace('(opsional)', '').trim()} wajib diisi`);
                            }
                        } else {
                            field.classList.remove('is-invalid');
                            field.style.borderColor = '';
                        }
                    }
                });

                // Event listener untuk hapus error saat user mengetik
                form.querySelectorAll('input, textarea, select').forEach(field => {
                    field.addEventListener('input', function() {
                        if (this.value.trim() !== '') {
                            this.classList.remove('is-invalid');
                            this.style.borderColor = '';
                        }
                    });
                    field.addEventListener('change', function() {
                        if (this.value.trim() !== '') {
                            this.classList.remove('is-invalid');
                            this.style.borderColor = '';
                        }
                    });
                });

                if (!isValid) {
                    e.preventDefault();
                    if (errorMessages.length > 0) {
                        alert('Data belum lengkap. Silakan isi semua field yang wajib:\\n\\n' + errorMessages.join('\\n'));
                    } else {
                        alert('Silakan periksa tanggal yang Anda masukkan. Tanggal tidak boleh sebelum hari ini.');
                    }
                }
            });
        }

        // Fungsi untuk menentukan field required berdasarkan jenis surat
        function getRequiredFieldsForSurat(jenisSurat) {
            const requiredFields = {
                'Surat Domisili': ['nik', 'alamat_ktp', 'dusun_domisili', 'rt_domisili', 'rw_domisili', 'alamat_domisili', 'tanggal_mulai_tinggal', 'lama_tinggal', 'alasan_domisili', 'no_hp_domisili'],
                'Surat Keterangan Usaha': ['nik_usaha', 'nama_usaha', 'alamat_usaha', 'jenis_usaha', 'tanggal_mulai_usaha', 'modal_usaha', 'jumlah_karyawan', 'no_hp_usaha'],
                'Surat Pengantar KTP': ['nik_ktp', 'nama_ktp', 'alamat_ktp_ktp', 'jenis_permohonan', 'alasan_permohonan', 'no_hp_ktp'],
                'Surat Kelahiran': ['nama_bayi', 'jenis_kelamin_bayi', 'tempat_lahir_bayi', 'tanggal_lahir_bayi', 'berat_bayi', 'panjang_bayi', 'nama_ayah', 'nik_ayah', 'nama_ibu', 'nik_ibu', 'alamat_orangtua', 'no_kk_kelahiran', 'lampiran_kelahiran'],
                'Surat Kematian': ['nama_almarhum', 'nik_almarhum', 'umur_almarhum', 'alamat_almarhum', 'tanggal_meninggal', 'tempat_meninggal', 'hubungan_pemohon'],
                'Surat Keterangan Tidak Mampu': ['nik_sktm', 'nama_sktm', 'alamat_sktm', 'status_pekerjaan', 'penghasilan_bulanan', 'jumlah_anggota_keluarga', 'status_rumah', 'tujuan_sktm', 'no_hp_sktm'],
                'Surat Pengantar KUA': ['nama_calon_suami', 'nik_calon_suami', 'alamat_calon_suami', 'pekerjaan_suami', 'nama_calon_istri', 'nik_calon_istri', 'alamat_calon_istri', 'pekerjaan_istri', 'tanggal_nikah', 'tempat_nikah'],
                'Surat Keterangan Belum Menikah': ['nik_belum_menikah', 'nama_belum_menikah', 'alamat_belum_menikah', 'tujuan_belum_menikah', 'instansi_belum_menikah'],
                'Surat Keterangan Tanah': ['lokasi_tanah', 'luas_tanah', 'peruntukan', 'batas_utara', 'batas_selatan', 'batas_timur', 'batas_barat', 'status_tanah'],
                'Surat Undangan Rapat': ['tipe_rapat', 'judul_rapat', 'agenda_rapat', 'tanggal_rapat', 'waktu_rapat', 'tempat_rapat', 'penerima_undangan', 'penanggung_jawab']
            };
            return requiredFields[jenisSurat] || [];
        }

        // Validasi Input: NIK - hanya angka, 16 digit
        const nikInputs = document.querySelectorAll('#nik, #nik_usaha, #nik_ktp, #nik_almarhum, #nik_sktm, #nik_calon_suami, #nik_calon_istri, #nik_belum_menikah');
        nikInputs.forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 16) {
                    this.value = this.value.slice(0, 16);
                }
            });
        });

        // Validasi Input: RT dan RW - hanya angka
        const rtRwInputs = document.querySelectorAll('#rt_domisili, #rw_domisili');
        rtRwInputs.forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });

        // Validasi Input: No. HP - hanya angka, 10-13 digit
        const phoneInputs = document.querySelectorAll('#no_hp_domisili, #no_hp_usaha, #no_hp_sktm, #no_hp_ktp');
        phoneInputs.forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 13) {
                    this.value = this.value.slice(0, 13);
                }
            });

            input.addEventListener('blur', function() {
                if (this.value.length > 0 && (this.value.length < 10 || this.value.length > 13)) {
                    alert('Nomor HP harus 10-13 digit!');
                    this.focus();
                }
            });
        });

        // Validasi Tanggal Mulai Tinggal (Domisili) - tidak boleh maju dari hari ini
        const tglMulaiTinggal = document.getElementById('tanggal_mulai_tinggal');
        if (tglMulaiTinggal) {
            const today = new Date().toISOString().split('T')[0];
            tglMulaiTinggal.max = today;
        }

        // Tanggal Lahir Bayi dan Tanggal Meninggal - bisa maju atau mundur (tanpa batasan)
        // Jadi tidak perlu ada validasi khusus, biarkan user memilih tanggal apapun

        // Validasi Lama Usaha berdasarkan Tanggal Mulai Usaha
        const tglMulaiUsaha = document.getElementById('tanggal_mulai_usaha');
        const lamaUsaha = document.getElementById('lama_usaha');
        
        if (tglMulaiUsaha && lamaUsaha) {
            const checkLamaUsaha = () => {
                const tglMulai = new Date(tglMulaiUsaha.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                if (tglMulai < today) {
                    lamaUsaha.required = true;
                    lamaUsaha.style.borderColor = '#dc3545';
                } else {
                    lamaUsaha.required = false;
                    lamaUsaha.style.borderColor = '';
                }
            };
            
            tglMulaiUsaha.addEventListener('change', checkLamaUsaha);
        }

        // Validasi Jam Undangan Rapat - jika tanggal = hari ini, jam tidak boleh sebelum jam sekarang
        const tglRapat = document.getElementById('tanggal_rapat');
        const jamRapat = document.getElementById('waktu_rapat');
        
        if (tglRapat && jamRapat) {
            const checkJamRapat = () => {
                const tglRapatVal = tglRapat.value;
                const today = new Date().toISOString().split('T')[0];
                
                if (tglRapatVal === today) {
                    const now = new Date().toTimeString().slice(0, 5);
                    jamRapat.min = now;
                } else {
                    jamRapat.min = '';
                }
            };
            
            tglRapat.addEventListener('change', checkJamRapat);
        }
    });
</script>
@endsection
