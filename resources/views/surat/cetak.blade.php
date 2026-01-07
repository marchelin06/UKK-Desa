<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat - {{ $surat->jenis_surat }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.6;
            color: #333;
            background-color: #fff;
        }

        .container {
            max-width: 210mm;
            height: 297mm;
            margin: 0 auto;
            padding: 2cm;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .kop-surat .nama-desa {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .kop-surat .alamat {
            font-size: 12px;
            margin-bottom: 5px;
        }

        .kop-surat .info-kontak {
            font-size: 10px;
            color: #666;
        }

        .judul-surat {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nomor-surat {
            text-align: center;
            font-size: 12px;
            margin-bottom: 30px;
            color: #666;
        }

        .konten {
            font-size: 12px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .konten p {
            margin-bottom: 12px;
            text-align: justify;
        }

        .data-tambahan {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 3px solid #1b5e20;
        }

        .data-item {
            margin-bottom: 10px;
            font-size: 12px;
        }

        .data-label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }

        .ttd-section {
            margin-top: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            text-align: center;
        }

        .ttd-box {
            text-align: center;
        }

        .ttd-box p {
            font-size: 12px;
            margin-bottom: 60px;
        }

        .ttd-box .garis {
            border-top: 1px solid #000;
            margin-top: 10px;
            padding-top: 5px;
            font-size: 12px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        @media print {
            body {
                background: white;
            }

            .container {
                box-shadow: none;
                max-width: 100%;
                height: auto;
                margin: 0;
                padding: 2cm;
            }

            .print-button {
                display: none;
            }
        }

        .print-button {
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #1b5e20;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .print-button:hover {
            background-color: #145c42;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .status-approved {
            background-color: #c8e6c9;
            color: #1b5e20;
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">🖨️ Cetak / Print</button>

    <div class="container">
        <!-- KOP SURAT -->
        <div class="kop-surat">
            <div class="nama-desa">DESA FINISHING</div>
            <div class="alamat">Kecamatan Setiajaya, Kabupaten Jaya</div>
            <div class="info-kontak">Telepon: (0274) 123456 | Email: desa@finishing.id</div>
        </div>

        <!-- JUDUL SURAT -->
        <div class="judul-surat">{{ $surat->jenis_surat }}</div>

        @if ($surat->status === 'disetujui')
            <div class="status-badge status-approved">✓ SURAT DISETUJUI</div>
        @endif

        <!-- NOMOR SURAT -->
        <div class="nomor-surat">
            Nomor: {{ str_pad($surat->id, 4, '0', STR_PAD_LEFT) }}/DS/{{ date('Y', strtotime($surat->created_at)) }}
        </div>

        <!-- KONTEN SURAT -->
        <div class="konten">
            <p>Yang bertanda tangan di bawah ini, Kepala Desa Finishing, menerangkan bahwa:</p>

            <p style="margin-left: 2cm;">
                <strong>Nama</strong> : {{ $surat->user->name ?? '-' }}<br>
                <strong>NIK</strong> : {{ $surat->data_tambahan['nik'] ?? $surat->data_tambahan['nik_usaha'] ?? $surat->data_tambahan['nik_ktp'] ?? '-' }}<br>
                <strong>Alamat</strong> : {{ $surat->user->address ?? '-' }}<br>
                <strong>Jenis Surat</strong> : {{ $surat->jenis_surat }}<br>
            </p>

            <p>
                Berdasarkan surat permohonan yang telah diajukan dan setelah dilakukan penelitian oleh perangkat desa, dengan ini kami menyatakan bahwa data dan informasi di atas adalah benar.
            </p>

            <p>
                Surat keterangan ini diberikan untuk keperluan: <strong>{{ $surat->keterangan ?? 'Kebutuhan Administratif' }}</strong>
            </p>

            <p>
                Demikian surat keterangan ini dibuat dan diberikan kepada yang berkepentingan untuk dipergunakan sebagaimana mestinya.
            </p>
        </div>

        <!-- DATA TAMBAHAN -->
        @if ($surat->data_tambahan && is_array($surat->data_tambahan))
            <div class="data-tambahan">
                @foreach ($surat->data_tambahan as $key => $value)
                    @if ($key !== 'lampiran' && $value)
                        <div class="data-item">
                            <span class="data-label">{{ ucwords(str_replace('_', ' ', $key)) }}:</span>
                            <span>{{ $value }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        <!-- TANDA TANGAN -->
        <div class="ttd-section">
            <div class="ttd-box">
                <p>Diajukan,</p>
                <div class="garis">
                    {{ $surat->user->name ?? '-' }}
                </div>
            </div>
            <div class="ttd-box">
                <p>Desa Finishing,</p>
                <div class="garis">
                    Kepala Desa
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <p>Dicetak pada: {{ now()->format('d-m-Y H:i:s') }} | Status: {{ ucfirst($surat->status) }}</p>
        </div>
    </div>
</body>
</html>
