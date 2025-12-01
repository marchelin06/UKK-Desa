@extends('layouts.app')

@section('content')
<style>
    .page-detail-surat {
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 15px;
        font-family: Arial, sans-serif;
    }
    .page-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #1b3b2f;
    }
    .card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        padding: 20px 25px;
        margin-bottom: 20px;
    }
    .card-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 12px;
        color: #1b3b2f;
    }
    .label {
        font-weight: 600;
        color: #444;
    }
    .value {
        color: #333;
    }
    .text-muted {
        color: #777;
        font-size: 13px;
    }
    .badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-menunggu { background: #fff3cd; color: #856404; }
    .badge-disetujui { background: #d4edda; color: #155724; }
    .badge-ditolak { background: #f8d7da; color: #721c24; }

    .btn-success {
        background: #198754;
        border: none;
        color: #fff;
        padding: 8px 18px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        margin-right: 5px;
    }
    .btn-danger {
        background: #dc3545;
        border: none;
        color: #fff;
        padding: 8px 18px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        margin-right: 5px;
    }
    .btn-secondary {
        background: #6c757d;
        border: none;
        color: #fff;
        padding: 8px 18px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }
    .btn-back {
        display: inline-block;
        margin-bottom: 10px;
        font-size: 13px;
        text-decoration: none;
        color: #1a7f5a;
    }
    .form-group {
        margin-bottom: 10px;
    }
    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .form-control, .form-select, textarea {
        width: 100%;
        padding: 8px 10px;
        border-radius: 5px;
        border: 1px solid #ccd0d5;
        font-size: 13px;
        box-sizing: border-box;
    }
    textarea {
        resize: vertical;
    }
</style>

@php
    $status = $surat->status ?? 'menunggu';
    $badgeClass = match ($status) {
        'disetujui' => 'badge-disetujui',
        'ditolak'   => 'badge-ditolak',
        default     => 'badge-menunggu',
    };
    $dataTambahan = $surat->data_tambahan ?? [];
@endphp

<div class="page-detail-surat">
    <a href="{{ route('admin.surat') }}" class="btn-back">&larr; Kembali ke daftar</a>

    <h1 class="page-title">Detail Surat</h1>

    {{-- INFO SURAT --}}
    <div class="card">
        <h2 class="card-title">{{ $surat->jenis_surat }}</h2>

        <p><span class="label">ID:</span> <span class="value">{{ $surat->id }}</span></p>
        <p><span class="label">Nama Pemohon:</span> <span class="value">{{ $surat->user->name ?? '-' }}</span></p>
        <p><span class="label">Keterangan:</span> <span class="value">{{ $surat->keterangan ?: '-' }}</span></p>
        <p>
            <span class="label">Status:</span>
            <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
        </p>
        <p><span class="label">Tipe Pengajuan:</span> <span class="value">{{ ucfirst($surat->tipe_pengajuan ?? 'manual') }}</span></p>

        @if(is_array($surat->data_tambahan) && count($surat->data_tambahan) > 0)
            <hr>
            <p class="label">Data Tambahan:</p>
            <ul>
                @foreach($surat->data_tambahan as $key => $val)
                    @if($key === 'lampiran')
                    <li>
                        <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong>
                        <img src="{{asset('storage')}}/{{ is_array($val) ? json_encode($val) : $val }}" alt="">
                        <!-- <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong>
                        {{ is_array($val) ? json_encode($val) : $val }} -->
                    </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>

    {{-- KEPUTUSAN ADMIN + ESTIMASI --}}
    <div class="card">
        <h2 class="card-title">Keputusan Admin</h2>

        <form id="formKeputusan" action="{{ route('admin.surat.keputusan', $surat->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" id="statusInput" value="{{ $surat->status }}">

            <div class="form-group">
                <label for="estimasi_selesai">Estimasi Surat Selesai</label>
                <input type="datetime-local"
                       name="estimasi_selesai"
                       id="estimasi_selesai"
                       class="form-control"
                       value="{{ $surat->estimasi_selesai ? $surat->estimasi_selesai->format('Y-m-d\TH:i') : '' }}">
                <small class="text-muted">
                    Contoh: jika surat diperkirakan selesai besok jam 10:00, pilih tanggal besok dan jam 10:00.
                </small>
            </div>

            <div class="form-group">
                <label for="catatan_admin">Catatan untuk Pemohon (opsional)</label>
                <textarea name="catatan_admin" id="catatan_admin" rows="3" class="form-control"
                          placeholder="Contoh: Silakan membawa KK asli saat pengambilan.">{{ old('catatan_admin', $surat->catatan_admin) }}</textarea>
            </div>

            <div class="form-group">
                <label for="alasan_penolakan">Alasan Penolakan (wajib jika ditolak)</label>
                <textarea name="alasan_penolakan" id="alasan_penolakan" rows="3" class="form-control"
                          placeholder="Tulis alasan jika surat ditolak.">{{ old('alasan_penolakan', $surat->alasan_penolakan) }}</textarea>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top:10px;">
                    <ul style="margin-bottom:0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="margin-top:15px;">
                <button type="button" class="btn-success" onclick="submitKeputusan('disetujui')">
                    Setujui
                </button>
                <button type="button" class="btn-danger" onclick="submitKeputusan('ditolak')">
                    Tolak
                </button>
                <a href="{{ route('admin.surat') }}" class="btn-secondary">
                    Kembali ke daftar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function submitKeputusan(status) {
        const statusInput  = document.getElementById('statusInput');
        const estimasiInput = document.getElementById('estimasi_selesai');
        const alasanInput   = document.getElementById('alasan_penolakan');

        statusInput.value = status;

        if (status === 'disetujui') {
            if (!estimasiInput.value) {
                const lanjut = confirm('Estimasi selesai belum diisi. Tetap setujui tanpa estimasi?');
                if (!lanjut) return;
            }
            if (!confirm('Setujui surat ini?')) return;
        } else if (status === 'ditolak') {
            if (!alasanInput.value.trim()) {
                alert('Alasan penolakan wajib diisi jika surat ditolak.');
                return;
            }
            if (!confirm('Tolak surat ini?')) return;
        }

        document.getElementById('formKeputusan').submit();
    }
</script>
@endsection
