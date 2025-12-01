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
        // tipe pengajuan (manual / online)
        $tipe = $request->input('tipe_pengajuan', 'manual');
        if (! in_array($tipe, ['manual', 'online'])) {
            $tipe = 'manual';
        }

        $request->validate([
            'jenis_surat' => 'required|string',
            'keterangan'  => 'nullable|string',
            'lampiran'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $dataTambahan = [];
        $lampiranPath = null;

        // simpan lampiran (opsional)
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran_surat', 'public');
            $dataTambahan['lampiran'] = $lampiranPath;
        }

        // TODO: di masa depan kalau mau simpan field detail per jenis surat,
        // tinggal ambil dari $request dan masukkan ke $dataTambahan.

        Surat::create([
            'user_id'        => Auth::id(),
            'jenis_surat'    => $request->jenis_surat,
            'keterangan'     => $request->keterangan,
            'status'         => 'menunggu',
            'tipe_pengajuan' => $tipe,
            'data_tambahan'  => !empty($dataTambahan) ? $dataTambahan : null,
        ]);

        return redirect()->back()->with('success', 'Pengajuan surat berhasil dikirim!');
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
}
