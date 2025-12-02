<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource (untuk warga - hanya lihat).
     */
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal_mulai', 'desc')->get();
        
        return view('kegiatan.index', compact('kegiatans'));
    }

    /**
     * Show the form for creating a new resource (admin only).
     */
    public function create()
    {
        return view('kegiatan.create');
    }

    /**
     * Store a newly created resource in storage (admin only).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan' => 'nullable|string',
            'tanggal_mulai' => 'required|date_format:Y-m-d\TH:i',
            'tanggal_selesai' => 'nullable|date_format:Y-m-d\TH:i|after:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'kategori' => 'required|in:Umum,Sosial,Infrastruktur,Pendidikan,Kesehatan,Keagamaan,Olahraga',
            'peserta' => 'nullable|string',
            'jumlah_peserta' => 'nullable|integer|min:0',
            'status' => 'required|in:direncanakan,berlangsung,selesai,dibatalkan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hasil' => 'nullable|string',
            'anggaran' => 'nullable|string',
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi',
            'deskripsi.required' => 'Deskripsi kegiatan wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_mulai.date_format' => 'Format tanggal mulai tidak valid',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi',
            'penyelenggara.required' => 'Penyelenggara wajib diisi',
            'kategori.required' => 'Kategori kegiatan wajib dipilih',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('kegiatan', 'public');
        }

        Kegiatan::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'tujuan' => $validated['tujuan'] ?? null,
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
            'lokasi' => $validated['lokasi'],
            'penyelenggara' => $validated['penyelenggara'],
            'penanggung_jawab' => $validated['penanggung_jawab'] ?? null,
            'kategori' => $validated['kategori'],
            'peserta' => $validated['peserta'] ?? null,
            'jumlah_peserta' => $validated['jumlah_peserta'] ?? null,
            'status' => $validated['status'],
            'foto' => $fotoPath,
            'hasil' => $validated['hasil'] ?? null,
            'anggaran' => $validated['anggaran'] ?? null,
        ]);

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatan.show', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource (admin only).
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage (admin only).
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan' => 'nullable|string',
            'tanggal_mulai' => 'required|date_format:Y-m-d\TH:i',
            'tanggal_selesai' => 'nullable|date_format:Y-m-d\TH:i|after:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'kategori' => 'required|in:Umum,Sosial,Infrastruktur,Pendidikan,Kesehatan,Keagamaan,Olahraga',
            'peserta' => 'nullable|string',
            'jumlah_peserta' => 'nullable|integer|min:0',
            'status' => 'required|in:direncanakan,berlangsung,selesai,dibatalkan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hasil' => 'nullable|string',
            'anggaran' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($kegiatan->foto) {
                \Storage::disk('public')->delete($kegiatan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('kegiatan', 'public');
        }

        $kegiatan->update($validated);

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage (admin only).
     */
    public function destroy(Kegiatan $kegiatan)
    {
        // Hapus foto jika ada
        if ($kegiatan->foto) {
            \Storage::disk('public')->delete($kegiatan->foto);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil dihapus!');
    }
}

