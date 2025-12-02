@extends('layouts.app')

@section('content')
<style>
    .page-detail-surat {
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 15px;
        font-family: 'Poppins', sans-serif;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #1b5e20;
    }

    .page-subtitle {
        color: #666;
        font-size: 14px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 20px;
        font-size: 14px;
        text-decoration: none;
        color: #1a7f5a;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        color: #145c42;
        gap: 10px;
    }

    .card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        padding: 24px;
        margin-bottom: 24px;
        border: 1px solid rgba(27, 94, 32, 0.05);
    }

    .card-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #1b5e20;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-title::before {
        content: '';
        width: 4px;
        height: 24px;
        background: linear-gradient(180deg, #1b5e20 0%, #43a047 100%);
        border-radius: 2px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .info-item {
        background: linear-gradient(135deg, #f8f9f7 0%, #f1f8f0 100%);
        border-radius: 10px;
        padding: 16px;
        border: 1px solid rgba(67, 160, 71, 0.1);
        transition: all 0.3s ease;
    }

    .info-item:hover {
        border-color: rgba(67, 160, 71, 0.3);
        box-shadow: 0 4px 12px rgba(67, 160, 71, 0.1);
    }

    .info-label {
        font-size: 12px;
        font-weight: 700;
        color: #1b5e20;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 15px;
        color: #333;
        word-break: break-word;
        line-height: 1.5;
    }

    .badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
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

    .data-tambahan-section {
        background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e9 100%);
        border-radius: 10px;
        padding: 20px;
        border: 1px solid #c8e6c9;
        margin-top: 20px;
    }

    .data-tambahan-title {
        font-size: 14px;
        font-weight: 700;
        color: #1b5e20;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 15px;
    }

    .data-tambahan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
    }

    .data-item {
        background: #ffffff;
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #c8e6c9;
    }

    .data-item-label {
        font-size: 11px;
        font-weight: 700;
        color: #558b2f;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .data-item-value {
        font-size: 14px;
        color: #333;
        word-break: break-word;
        line-height: 1.5;
        white-space: pre-wrap;
    }

    .lampiran-preview {
        background: #ffffff;
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #c8e6c9;
    }

    .lampiran-image {
        max-width: 100%;
        max-height: 300px;
        border-radius: 6px;
        margin-top: 10px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #1b5e20;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control, .form-select, textarea {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #ccd0d5;
        font-size: 14px;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus, textarea:focus {
        outline: none;
        border-color: #1a7f5a;
        box-shadow: 0 0 0 3px rgba(26, 127, 90, 0.1);
    }

    textarea {
        resize: vertical;
    }

    .text-muted {
        color: #888;
        font-size: 12px;
        margin-top: 4px;
    }

    .btn {
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-right: 8px;
        margin-bottom: 8px;
    }

    .btn-success {
        background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(67, 160, 71, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(67, 160, 71, 0.4);
    }

    .btn-danger {
        background: linear-gradient(135deg, #f44336 0%, #ef5350 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(244, 67, 54, 0.4);
    }

    .btn-secondary {
        background: #6c757d;
        color: #fff;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-top: 16px;
    }

    .alert-danger {
        background: #fdecea;
        border: 1px solid #f5c2c0;
        color: #b02a37;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }

    .divider {
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, #c8e6c9 50%, transparent 100%);
        margin: 20px 0;
    }

    @media (max-width: 768px) {
        .page-detail-surat {
            padding: 0 10px;
        }

        .page-title {
            font-size: 24px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .data-tambahan-grid {
            grid-template-columns: 1fr;
        }

        .btn {
            width: 100%;
            text-align: center;
            margin-right: 0;
            margin-bottom: 10px;
        }
    }
</style>

@php
    $status = $surat->status ?? 'menunggu';
    $badgeClass = match ($status) {
        'disetujui' => 'badge-disetujui',
        'ditolak'   => 'badge-ditolak',
        default     => 'badge-menunggu',
    };
    $dataTambahan = is_array($surat->data_tambahan) ? $surat->data_tambahan : [];
@endphp

<div class="page-detail-surat">
    <a href="{{ route('admin.surat') }}" class="btn-back">
        <span>←</span> Kembali ke daftar pengajuan
    </a>

    <div class="page-header">
        <h1 class="page-title">{{ $surat->jenis_surat }}</h1>
        <p class="page-subtitle">Detail pengajuan surat dari warga desa</p>
    </div>

    {{-- INFO SURAT UTAMA --}}
    <div class="card">
        <h2 class="card-title">Informasi Pengajuan</h2>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">ID Pengajuan</div>
                <div class="info-value">#{{ str_pad($surat->id, 4, '0', STR_PAD_LEFT) }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Nama Pemohon</div>
                <div class="info-value">{{ $surat->user->name ?? '-' }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Status</div>
                <div class="info-value">
                    <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Tanggal Pengajuan</div>
                <div class="info-value">{{ $surat->created_at?->format('d-m-Y H:i') ?? '-' }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Jenis Pengajuan</div>
                <div class="info-value">{{ ucfirst($surat->tipe_pengajuan ?? 'online') }}</div>
            </div>

            @if($surat->estimasi_selesai)
            <div class="info-item">
                <div class="info-label">Estimasi Selesai</div>
                <div class="info-value">{{ $surat->estimasi_selesai->format('d-m-Y H:i') }}</div>
            </div>
            @endif
        </div>

        @if($surat->keterangan)
        <div class="divider"></div>
        <div style="background: #f8f9f7; border-radius: 10px; padding: 16px; border-left: 4px solid #1b5e20;">
            <div class="info-label" style="margin-bottom: 8px;">Keterangan Singkat</div>
            <div class="info-value">{{ $surat->keterangan }}</div>
        </div>
        @endif

        @if($surat->catatan_admin)
        <div class="divider"></div>
        <div style="background: #e3f2fd; border-radius: 10px; padding: 16px; border-left: 4px solid #1565c0;">
            <div class="info-label" style="color: #0d47a1; margin-bottom: 8px;">💬 Catatan Admin</div>
            <div class="info-value">{{ $surat->catatan_admin }}</div>
        </div>
        @endif

        @if($surat->alasan_penolakan)
        <div class="divider"></div>
        <div style="background: #fdecea; border-radius: 10px; padding: 16px; border-left: 4px solid #c62828;">
            <div class="info-label" style="color: #b02a37; margin-bottom: 8px;">⚠️ Alasan Penolakan</div>
            <div class="info-value">{{ $surat->alasan_penolakan }}</div>
        </div>
        @endif
    </div>

    {{-- DATA TAMBAHAN --}}
    @if(!empty($dataTambahan))
    <div class="card">
        <h2 class="card-title">Data Tambahan Pengajuan</h2>

        @php
            $dataTambahanFiltered = array_filter($dataTambahan, function($key) {
                return $key !== 'lampiran';
            }, ARRAY_FILTER_USE_KEY);
        @endphp

        @if(!empty($dataTambahanFiltered))
        <div class="data-tambahan-section">
            <div class="data-tambahan-title">📋 Detail Data Pengajuan</div>
            <div class="data-tambahan-grid">
                @foreach($dataTambahanFiltered as $key => $val)
                <div class="data-item">
                    <div class="data-item-label">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
                    <div class="data-item-value">
                        @if(is_array($val))
                            {{ json_encode($val, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                        @else
                            {{ $val ?: '-' }}
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- LAMPIRAN --}}
        @if(isset($dataTambahan['lampiran']))
        <div class="data-tambahan-section" style="margin-top: 20px;">
            <div class="data-tambahan-title">📎 Lampiran Dokumen</div>
            <div class="lampiran-preview">
                @php
                    $lampiranPath = $dataTambahan['lampiran'];
                    $lampiranPath = is_array($lampiranPath) ? json_encode($lampiranPath) : $lampiranPath;
                    $ext = pathinfo($lampiranPath, PATHINFO_EXTENSION);
                @endphp

                @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                    <div style="text-align: center;">
                        <img src="{{ asset('storage/' . $lampiranPath) }}"
                             alt="Lampiran"
                             class="lampiran-image">
                        <p style="font-size: 12px; color: #888; margin-top: 10px;">
                            📷 {{ basename($lampiranPath) }}
                        </p>
                    </div>
                @elseif(strtolower($ext) === 'pdf')
                    <div style="text-align: center; padding: 20px;">
                        <p style="font-size: 48px; margin: 0;">📄</p>
                        <p style="font-size: 12px; color: #888; margin-top: 10px;">
                            {{ basename($lampiranPath) }}
                        </p>
                        <a href="{{ asset('storage/' . $lampiranPath) }}"
                           target="_blank"
                           class="btn btn-success"
                           style="margin-top: 10px; display: inline-block;">
                            Buka PDF
                        </a>
                    </div>
                @else
                    <div style="text-align: center; padding: 20px;">
                        <p style="font-size: 48px; margin: 0;">📁</p>
                        <p style="font-size: 12px; color: #888; margin-top: 10px;">
                            {{ basename($lampiranPath) }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>
    @endif

    {{-- KEPUTUSAN ADMIN --}}
    <div class="card">
        <h2 class="card-title">Keputusan Admin</h2>

        <form id="formKeputusan" action="{{ route('admin.surat.keputusan', $surat->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" id="statusInput" value="{{ $surat->status }}">

            <div class="form-group">
                <label for="estimasi_selesai">📅 Estimasi Surat Selesai</label>
                <input type="datetime-local"
                       name="estimasi_selesai"
                       id="estimasi_selesai"
                       class="form-control"
                       value="{{ $surat->estimasi_selesai ? $surat->estimasi_selesai->format('Y-m-d\TH:i') : '' }}">
                <small class="text-muted">
                    Tentukan kapan surat diperkirakan selesai diproses dan siap diambil.
                </small>
            </div>

            <div class="form-group">
                <label for="catatan_admin">💬 Catatan untuk Pemohon (opsional)</label>
                <textarea name="catatan_admin"
                          id="catatan_admin"
                          rows="3"
                          class="form-control"
                          placeholder="Contoh: Silakan membawa KK asli saat pengambilan di kantor desa.">{{ old('catatan_admin', $surat->catatan_admin) }}</textarea>
                <small class="text-muted">
                    Pesan ini akan dilihat oleh pemohon di halaman detail pengajuan mereka.
                </small>
            </div>

            <div class="form-group">
                <label for="alasan_penolakan">❌ Alasan Penolakan (wajib jika ditolak)</label>
                <textarea name="alasan_penolakan"
                          id="alasan_penolakan"
                          rows="3"
                          class="form-control"
                          placeholder="Jelaskan alasan mengapa surat ditolak sehingga pemohon memahami.">{{ old('alasan_penolakan', $surat->alasan_penolakan) }}</textarea>
                <small class="text-muted">
                    Wajib diisi jika Anda memilih untuk menolak pengajuan ini.
                </small>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-top: 24px;">
                <button type="button" class="btn btn-success" onclick="submitKeputusan('disetujui')">
                    ✓ Setujui Pengajuan
                </button>
                <button type="button" class="btn btn-danger" onclick="submitKeputusan('ditolak')">
                    ✕ Tolak Pengajuan
                </button>
                <a href="{{ route('admin.surat') }}" class="btn btn-secondary">
                    ← Kembali ke Daftar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function submitKeputusan(status) {
        const statusInput = document.getElementById('statusInput');
        const estimasiInput = document.getElementById('estimasi_selesai');
        const alasanInput = document.getElementById('alasan_penolakan');

        statusInput.value = status;

        if (status === 'disetujui') {
            if (!estimasiInput.value) {
                const lanjut = confirm('⚠️ Estimasi selesai belum diisi. Tetap setujui tanpa estimasi?');
                if (!lanjut) return;
            }
            if (!confirm('✓ Setujui pengajuan surat ini?')) return;
        } else if (status === 'ditolak') {
            if (!alasanInput.value.trim()) {
                alert('❌ Alasan penolakan wajib diisi jika surat ditolak.');
                alasanInput.focus();
                return;
            }
            if (!confirm('✕ Tolak pengajuan surat ini? Pemohon akan menerima notifikasi.')) return;
        }

        document.getElementById('formKeputusan').submit();
    }
</script>
@endsection
