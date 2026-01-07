<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SuratController extends Controller
{
    // =========================
    // WARGA: LIHAT & AJUKAN
    // =========================
    public function index()
    {
        $surat = Surat::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('surat.warga', compact('surat'));
    }

    public function store(Request $request)
    {
        // Validasi dasar
        $baseRules = [
            'jenis_surat' => 'required|string',
            'keterangan'  => 'nullable|string',
            'lampiran'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];

        $messages = [];

        // Tentukan validasi berdasarkan jenis surat
        $jenisSurat = $request->jenis_surat;

        // === SURAT DOMISILI ===
        if ($jenisSurat === 'Surat Domisili') {
            $baseRules = array_merge($baseRules, [
                'nik' => 'required|string|max:16',
                'alamat_ktp' => 'required|string',
                'dusun_domisili' => 'required|string',
                'rt_domisili' => 'required|string',
                'rw_domisili' => 'required|string',
                'alamat_domisili' => 'required|string',
                'tanggal_mulai_tinggal' => 'required|date|date_format:Y-m-d',
                'lama_tinggal' => 'required|numeric|min:1',
                'alasan_domisili' => 'required|string',
                'no_hp_domisili' => 'required|string',
            ]);
            $messages = array_merge($messages, [
                'nik.required' => 'NIK harus diisi',
                'alamat_ktp.required' => 'Alamat KTP harus diisi',
                'dusun_domisili.required' => 'Dusun/Desa harus diisi',
                'rt_domisili.required' => 'RT harus diisi',
                'rw_domisili.required' => 'RW harus diisi',
                'alamat_domisili.required' => 'Alamat domisili harus diisi',
                'tanggal_mulai_tinggal.required' => 'Tanggal mulai tinggal harus diisi',
                'lama_tinggal.required' => 'Lama tinggal harus diisi',
                'alasan_domisili.required' => 'Alasan domisili harus diisi',
                'no_hp_domisili.required' => 'Nomor HP harus diisi',
            ]);
        }

        // === SURAT USAHA ===
        elseif ($jenisSurat === 'Surat Keterangan Usaha') {
            $baseRules = array_merge($baseRules, [
                'nik_usaha' => 'required|string|max:16',
                'nama_usaha' => 'required|string',
                'alamat_usaha' => 'required|string',
                'jenis_usaha' => 'required|string',
                'tanggal_mulai_usaha' => 'required|date|date_format:Y-m-d',
                'lama_usaha' => 'required|numeric|min:1',
                'modal_usaha' => 'required|numeric|min:1',
                'jumlah_karyawan' => 'required|numeric|min:0',
                'no_hp_usaha' => 'required|string',
            ]);
            $messages = array_merge($messages, [
                'nik_usaha.required' => 'NIK pemilik harus diisi',
                'nama_usaha.required' => 'Nama usaha harus diisi',
                'alamat_usaha.required' => 'Alamat usaha harus diisi',
                'jenis_usaha.required' => 'Jenis usaha harus diisi',
                'tanggal_mulai_usaha.required' => 'Tanggal mulai usaha harus diisi',
                'lama_usaha.required' => 'Lama usaha harus diisi',
                'modal_usaha.required' => 'Modal usaha harus diisi',
                'jumlah_karyawan.required' => 'Jumlah karyawan harus diisi',
                'no_hp_usaha.required' => 'Nomor HP harus diisi',
            ]);
        }

        // === SURAT PENGANTAR KTP ===
        elseif ($jenisSurat === 'Surat Pengantar KTP') {
            $baseRules = array_merge($baseRules, [
                'nik_ktp' => 'required|string|max:16',
                'nama_ktp' => 'required|string',
                'alamat_ktp_ktp' => 'required|string',
                'jenis_permohonan' => 'required|string',
                'alasan_permohonan' => 'required|string',
                'no_hp_ktp' => 'required|string',
            ]);
            $messages = array_merge($messages, [
                'nik_ktp.required' => 'NIK harus diisi',
                'nama_ktp.required' => 'Nama harus diisi',
                'alamat_ktp_ktp.required' => 'Alamat harus diisi',
                'jenis_permohonan.required' => 'Jenis permohonan harus diisi',
                'alasan_permohonan.required' => 'Alasan permohonan harus diisi',
                'no_hp_ktp.required' => 'Nomor HP harus diisi',
            ]);
        }

        // === SURAT KELAHIRAN ===
        elseif ($jenisSurat === 'Surat Kelahiran') {
            $baseRules = array_merge($baseRules, [
                'nama_bayi' => 'required|string',
                'jenis_kelamin_bayi' => 'required|string',
                'tempat_lahir_bayi' => 'required|string',
                'tanggal_lahir_bayi' => 'required|date|date_format:Y-m-d',
                'berat_bayi' => 'required|numeric|min:100|max:5000',
                'panjang_bayi' => 'required|numeric|min:30|max:60',
                'nama_ayah' => 'required|string',
                'nik_ayah' => 'required|string|max:16',
                'nama_ibu' => 'required|string',
                'nik_ibu' => 'required|string|max:16',
                'alamat_orangtua' => 'required|string',
            ]);
            $messages = array_merge($messages, [
                'nama_bayi.required' => 'Nama bayi harus diisi',
                'jenis_kelamin_bayi.required' => 'Jenis kelamin bayi harus diisi',
                'tempat_lahir_bayi.required' => 'Tempat lahir harus diisi',
                'tanggal_lahir_bayi.required' => 'Tanggal lahir harus diisi',
                'berat_bayi.required' => 'Berat bayi harus diisi',
                'panjang_bayi.required' => 'Panjang bayi harus diisi',
                'nama_ayah.required' => 'Nama ayah harus diisi',
                'nik_ayah.required' => 'NIK ayah harus diisi',
                'nama_ibu.required' => 'Nama ibu harus diisi',
                'nik_ibu.required' => 'NIK ibu harus diisi',
                'alamat_orangtua.required' => 'Alamat orang tua harus diisi',
            ]);
        }

        // === SURAT KEMATIAN ===
        elseif ($jenisSurat === 'Surat Kematian') {
            $baseRules = array_merge($baseRules, [
                'nama_almarhum' => 'required|string',
                'nik_almarhum' => 'required|string|max:16',
                'umur_almarhum' => 'required|numeric|min:0|max:150',
                'alamat_almarhum' => 'required|string',
                'tanggal_meninggal' => 'required|date|date_format:Y-m-d',
                'tempat_meninggal' => 'required|string',
                'sebab_meninggal' => 'required|string',
                'hubungan_pemohon' => 'required|string',
            ]);
            $messages = array_merge($messages, [
                'nama_almarhum.required' => 'Nama almarhum/almarhumah harus diisi',
                'nik_almarhum.required' => 'NIK almarhum/almarhumah harus diisi',
                'umur_almarhum.required' => 'Umur almarhum/almarhumah harus diisi',
                'alamat_almarhum.required' => 'Alamat almarhum/almarhumah harus diisi',
                'tanggal_meninggal.required' => 'Tanggal meninggal harus diisi',
                'tempat_meninggal.required' => 'Tempat meninggal harus diisi',
                'sebab_meninggal.required' => 'Sebab meninggal harus diisi',
                'hubungan_pemohon.required' => 'Hubungan dengan pemohon harus diisi',
            ]);
        }

        // === SURAT KETERANGAN TIDAK MAMPU ===
        elseif ($jenisSurat === 'Surat Keterangan Tidak Mampu') {
            $baseRules = array_merge($baseRules, [
                'nik_sktm' => 'required|string|max:16',
                'nama_sktm' => 'required|string',
                'alamat_sktm' => 'required|string',
                'status_pekerjaan' => 'required|string',
                'penghasilan_bulanan' => 'required|numeric|min:0',
                'jumlah_anggota_keluarga' => 'required|numeric|min:1',
                'status_rumah' => 'required|string',
                'tujuan_sktm' => 'required|string',
            ]);
            $messages = array_merge($messages, [
                'nik_sktm.required' => 'NIK harus diisi',
                'nama_sktm.required' => 'Nama harus diisi',
                'alamat_sktm.required' => 'Alamat harus diisi',
                'status_pekerjaan.required' => 'Status pekerjaan harus diisi',
                'penghasilan_bulanan.required' => 'Penghasilan bulanan harus diisi',
                'jumlah_anggota_keluarga.required' => 'Jumlah anggota keluarga harus diisi',
                'status_rumah.required' => 'Status rumah harus diisi',
                'tujuan_sktm.required' => 'Tujuan SKTM harus diisi',
            ]);
        }

        // === SURAT PENGANTAR KUA ===
        elseif ($jenisSurat === 'Surat Pengantar KUA') {
            $baseRules = array_merge($baseRules, [
                'nama_calon_suami' => 'required|string',
                'nik_calon_suami' => 'required|string|max:16',
                'alamat_calon_suami' => 'required|string',
                'pekerjaan_suami' => 'required|string',
                'nama_calon_istri' => 'required|string',
                'nik_calon_istri' => 'required|string|max:16',
                'alamat_calon_istri' => 'required|string',
                'pekerjaan_istri' => 'required|string',
                'tanggal_nikah' => 'required|date|date_format:Y-m-d',
                'tempat_nikah' => 'required|string',
            ]);
            $messages = array_merge($messages, [
                'nama_calon_suami.required' => 'Nama calon suami harus diisi',
                'nik_calon_suami.required' => 'NIK calon suami harus diisi',
                'alamat_calon_suami.required' => 'Alamat calon suami harus diisi',
                'pekerjaan_suami.required' => 'Pekerjaan calon suami harus diisi',
                'nama_calon_istri.required' => 'Nama calon istri harus diisi',
                'nik_calon_istri.required' => 'NIK calon istri harus diisi',
                'alamat_calon_istri.required' => 'Alamat calon istri harus diisi',
                'pekerjaan_istri.required' => 'Pekerjaan calon istri harus diisi',
                'tanggal_nikah.required' => 'Tanggal nikah harus diisi',
                'tempat_nikah.required' => 'Tempat akad nikah harus diisi',
            ]);
        }

        // === SURAT BELUM MENIKAH ===
        elseif ($jenisSurat === 'Surat Keterangan Belum Menikah') {
            $baseRules = array_merge($baseRules, [
                'nik_belum_menikah' => 'required|string|max:16',
                'nama_belum_menikah' => 'required|string',
                'alamat_belum_menikah' => 'required|string',
                'tujuan_belum_menikah' => 'required|string',
                'instansi_belum_menikah' => 'required|string',
            ]);
            $messages = array_merge($messages, [
                'nik_belum_menikah.required' => 'NIK harus diisi',
                'nama_belum_menikah.required' => 'Nama harus diisi',
                'alamat_belum_menikah.required' => 'Alamat harus diisi',
                'tujuan_belum_menikah.required' => 'Tujuan pengajuan harus diisi',
                'instansi_belum_menikah.required' => 'Nama instansi tujuan harus diisi',
            ]);
        }

        // === SURAT TANAH ===
        elseif ($jenisSurat === 'Surat Keterangan Tanah') {
            $baseRules = array_merge($baseRules, [
                'lokasi_tanah' => 'required|string',
                'luas_tanah' => 'required|numeric|min:1',
                'peruntukan' => 'required|string',
                'batas_utara' => 'required|string',
                'batas_selatan' => 'required|string',
                'batas_timur' => 'required|string',
                'batas_barat' => 'required|string',
                'status_tanah' => 'required|string',
            ]);
            $messages = array_merge($messages, [
                'lokasi_tanah.required' => 'Lokasi tanah harus diisi',
                'luas_tanah.required' => 'Luas tanah harus diisi',
                'peruntukan.required' => 'Peruntukan tanah harus diisi',
                'batas_utara.required' => 'Batas utara harus diisi',
                'batas_selatan.required' => 'Batas selatan harus diisi',
                'batas_timur.required' => 'Batas timur harus diisi',
                'batas_barat.required' => 'Batas barat harus diisi',
                'status_tanah.required' => 'Status kepemilikan tanah harus diisi',
            ]);
        }

        // === SURAT RAPAT ===
        elseif ($jenisSurat === 'Surat Undangan Rapat') {
            $baseRules = array_merge($baseRules, [
                'tipe_rapat' => 'required|string',
                'judul_rapat' => 'required|string',
                'agenda_rapat' => 'required|string',
                'tanggal_rapat' => 'required|date|date_format:Y-m-d',
                'waktu_rapat' => 'required|string',
                'tempat_rapat' => 'required|string',
                'penerima_undangan' => 'required|string',
                'penanggung_jawab' => 'required|string',
            ]);
            $messages = array_merge($messages, [
                'tipe_rapat.required' => 'Tipe rapat harus diisi',
                'judul_rapat.required' => 'Judul rapat harus diisi',
                'agenda_rapat.required' => 'Agenda rapat harus diisi',
                'tanggal_rapat.required' => 'Tanggal rapat harus diisi',
                'waktu_rapat.required' => 'Waktu rapat harus diisi',
                'tempat_rapat.required' => 'Tempat rapat harus diisi',
                'penerima_undangan.required' => 'Penerima undangan harus diisi',
                'penanggung_jawab.required' => 'Penanggung jawab rapat harus diisi',
            ]);
        }

        // Lakukan validasi
        $request->validate($baseRules, $messages);

        $dataTambahan = [];
        $lampiranPath = null;

        // simpan lampiran (opsional)
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran_surat', 'public');
            $dataTambahan['lampiran'] = $lampiranPath;
        }

        // Simpan semua field data tambahan berdasarkan jenis surat
        $this->saveDataTambahan($request, $jenisSurat, $dataTambahan);

        Surat::create([
            'user_id'        => Auth::id(),
            'jenis_surat'    => $request->jenis_surat,
            'keterangan'     => $request->keterangan,
            'status'         => 'menunggu',
            'tipe_pengajuan' => 'online',
            'data_tambahan'  => !empty($dataTambahan) ? $dataTambahan : null,
        ]);

        return redirect()->route('surat.index')->with('success', 'Pengajuan surat berhasil dikirim! Silakan lihat riwayat pengajuan Anda di bawah.');
    }

    private function saveDataTambahan($request, $jenisSurat, &$dataTambahan)
    {
        if ($jenisSurat === 'Surat Domisili') {
            $dataTambahan = array_merge($dataTambahan, [
                'nik' => $request->nik,
                'alamat_ktp' => $request->alamat_ktp,
                'dusun_domisili' => $request->dusun_domisili,
                'rt_domisili' => $request->rt_domisili,
                'rw_domisili' => $request->rw_domisili,
                'alamat_domisili' => $request->alamat_domisili,
                'tanggal_mulai_tinggal' => $request->tanggal_mulai_tinggal,
                'lama_tinggal' => $request->lama_tinggal,
                'alasan_domisili' => $request->alasan_domisili,
                'no_hp_domisili' => $request->no_hp_domisili,
            ]);
        } elseif ($jenisSurat === 'Surat Keterangan Usaha') {
            $dataTambahan = array_merge($dataTambahan, [
                'nik_usaha' => $request->nik_usaha,
                'nama_usaha' => $request->nama_usaha,
                'alamat_usaha' => $request->alamat_usaha,
                'jenis_usaha' => $request->jenis_usaha,
                'deskripsi_usaha' => $request->deskripsi_usaha,
                'tanggal_mulai_usaha' => $request->tanggal_mulai_usaha,
                'lama_usaha' => $request->lama_usaha,
                'modal_usaha' => $request->modal_usaha,
                'jumlah_karyawan' => $request->jumlah_karyawan,
                'no_hp_usaha' => $request->no_hp_usaha,
            ]);
        } elseif ($jenisSurat === 'Surat Pengantar KTP') {
            $dataTambahan = array_merge($dataTambahan, [
                'nik_ktp' => $request->nik_ktp,
                'nama_ktp' => $request->nama_ktp,
                'alamat_ktp_ktp' => $request->alamat_ktp_ktp,
                'jenis_permohonan' => $request->jenis_permohonan,
                'alasan_permohonan' => $request->alasan_permohonan,
                'no_hp_ktp' => $request->no_hp_ktp,
            ]);
        } elseif ($jenisSurat === 'Surat Kelahiran') {
            $dataTambahan = array_merge($dataTambahan, [
                'nama_bayi' => $request->nama_bayi,
                'jenis_kelamin_bayi' => $request->jenis_kelamin_bayi,
                'tempat_lahir_bayi' => $request->tempat_lahir_bayi,
                'tanggal_lahir_bayi' => $request->tanggal_lahir_bayi,
                'berat_bayi' => $request->berat_bayi,
                'panjang_bayi' => $request->panjang_bayi,
                'nama_ayah' => $request->nama_ayah,
                'nik_ayah' => $request->nik_ayah,
                'nama_ibu' => $request->nama_ibu,
                'nik_ibu' => $request->nik_ibu,
                'alamat_orangtua' => $request->alamat_orangtua,
            ]);
        } elseif ($jenisSurat === 'Surat Kematian') {
            $dataTambahan = array_merge($dataTambahan, [
                'nama_almarhum' => $request->nama_almarhum,
                'nik_almarhum' => $request->nik_almarhum,
                'umur_almarhum' => $request->umur_almarhum,
                'alamat_almarhum' => $request->alamat_almarhum,
                'tanggal_meninggal' => $request->tanggal_meninggal,
                'tempat_meninggal' => $request->tempat_meninggal,
                'sebab_meninggal' => $request->sebab_meninggal,
                'hubungan_pemohon' => $request->hubungan_pemohon,
            ]);
        } elseif ($jenisSurat === 'Surat Keterangan Tidak Mampu') {
            $dataTambahan = array_merge($dataTambahan, [
                'nik_sktm' => $request->nik_sktm,
                'nama_sktm' => $request->nama_sktm,
                'alamat_sktm' => $request->alamat_sktm,
                'status_pekerjaan' => $request->status_pekerjaan,
                'penghasilan_bulanan' => $request->penghasilan_bulanan,
                'jumlah_anggota_keluarga' => $request->jumlah_anggota_keluarga,
                'status_rumah' => $request->status_rumah,
                'tujuan_sktm' => $request->tujuan_sktm,
                'instansi_sktm' => $request->instansi_sktm,
                'keterangan_tambahan' => $request->keterangan_tambahan,
            ]);
        } elseif ($jenisSurat === 'Surat Pengantar KUA') {
            $dataTambahan = array_merge($dataTambahan, [
                'nama_calon_suami' => $request->nama_calon_suami,
                'nik_calon_suami' => $request->nik_calon_suami,
                'tempat_lahir_suami' => $request->tempat_lahir_suami,
                'alamat_calon_suami' => $request->alamat_calon_suami,
                'pekerjaan_suami' => $request->pekerjaan_suami,
                'nama_calon_istri' => $request->nama_calon_istri,
                'nik_calon_istri' => $request->nik_calon_istri,
                'tempat_lahir_istri' => $request->tempat_lahir_istri,
                'alamat_calon_istri' => $request->alamat_calon_istri,
                'pekerjaan_istri' => $request->pekerjaan_istri,
                'tanggal_nikah' => $request->tanggal_nikah,
                'tempat_nikah' => $request->tempat_nikah,
            ]);
        } elseif ($jenisSurat === 'Surat Keterangan Belum Menikah') {
            $dataTambahan = array_merge($dataTambahan, [
                'nik_belum_menikah' => $request->nik_belum_menikah,
                'nama_belum_menikah' => $request->nama_belum_menikah,
                'alamat_belum_menikah' => $request->alamat_belum_menikah,
                'tujuan_belum_menikah' => $request->tujuan_belum_menikah,
                'instansi_belum_menikah' => $request->instansi_belum_menikah,
            ]);
        } elseif ($jenisSurat === 'Surat Keterangan Tanah') {
            $dataTambahan = array_merge($dataTambahan, [
                'lokasi_tanah' => $request->lokasi_tanah,
                'luas_tanah' => $request->luas_tanah,
                'peruntukan' => $request->peruntukan,
                'batas_utara' => $request->batas_utara,
                'batas_selatan' => $request->batas_selatan,
                'batas_timur' => $request->batas_timur,
                'batas_barat' => $request->batas_barat,
                'status_tanah' => $request->status_tanah,
            ]);
        } elseif ($jenisSurat === 'Surat Undangan Rapat') {
            $dataTambahan = array_merge($dataTambahan, [
                'tipe_rapat' => $request->tipe_rapat,
                'judul_rapat' => $request->judul_rapat,
                'agenda_rapat' => $request->agenda_rapat,
                'tanggal_rapat' => $request->tanggal_rapat,
                'waktu_rapat' => $request->waktu_rapat,
                'tempat_rapat' => $request->tempat_rapat,
                'penerima_undangan' => $request->penerima_undangan,
                'penanggung_jawab' => $request->penanggung_jawab,
                'catatan_rapat' => $request->catatan_rapat,
            ]);
        }
    }

    // =========================
    // ADMIN: DAFTAR PENGAJUAN
    // =========================
    public function adminIndex()
    {
        $surat = Surat::with('user')
            ->orderByDesc('created_at')
            ->get();

        return view('surat.admin', compact('surat'));
    }

    // =========================
    // ADMIN: DETAIL SATU SURAT
    // =========================
    public function show($id)
    {
        $surat = Surat::with('user')->findOrFail($id);

        // dd($surat->data_tambahan['lampiran']);

        return view('surat.show', compact('surat'));
    }

    public function updateStatus(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $request->validate([
            'status'           => 'required|in:menunggu,disetujui,ditolak',
            'estimasi_selesai' => 'nullable|date',
            'catatan_admin'    => 'nullable|string',
            'alasan_penolakan' => $request->status === 'ditolak'
                                  ? 'required|string'
                                  : 'nullable|string',
        ], [
            'alasan_penolakan.required' => 'Alasan penolakan wajib diisi jika surat ditolak.',
        ]);

        // parsing datetime-local ke format yang aman untuk DB
        $estimasi = $request->estimasi_selesai
            ? Carbon::parse($request->estimasi_selesai)
            : null;

        $surat->status           = $request->status;
        $surat->estimasi_selesai = $estimasi;
        $surat->catatan_admin    = $request->catatan_admin;

        // hanya simpan alasan jika status ditolak
        $surat->alasan_penolakan = $request->status === 'ditolak'
            ? $request->alasan_penolakan
            : null;

        $surat->save();

        return redirect()
            ->route('admin.surat.show', $surat->id)
            ->with('success', 'Keputusan berhasil disimpan.');
    }

    // =========================
    // OPSI CEPAT (JIKA MASIH MAU)
    // =========================
    // Tombol cepat setujui/tolak (tanpa estimasi & alasan).
    // Kalau tidak dipakai di view, boleh nanti dihapus.
    public function setujui($id)
    {
        $surat = Surat::findOrFail($id);

        $surat->status = 'disetujui';
        $surat->save();

        return back()->with('success', 'Surat disetujui!');
    }

    public function tolak($id)
    {
        $surat = Surat::findOrFail($id);

        $surat->status           = 'ditolak';
        $surat->alasan_penolakan = $surat->alasan_penolakan ?? 'Ditolak tanpa keterangan.';
        $surat->save();

        return back()->with('success', 'Surat ditolak!');
    }

    // =========================
    // CETAK SURAT (PDF)
    // =========================
    public function cetak($id)
    {
        $surat = Surat::with('user')->findOrFail($id);

        // Hanya warga pemilik surat atau admin yang bisa cetak
        if (Auth::id() !== $surat->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Untuk saat ini, return view cetak
        // Bisa dikembangkan dengan dompdf nanti untuk generate PDF
        return view('surat.cetak', compact('surat'));
    }
}
