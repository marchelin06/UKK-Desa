<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Menampilkan form pengaduan (untuk warga)
     */
    public function create()
    {
        return view('pengaduan.create');
    }

    /**
     * Menyimpan data pengaduan ke database (untuk warga)
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_pengirim' => 'required|string|max:255',
            'masalah' => 'required|string|min:10',
            'lokasi' => 'required|string|max:255',
        ], [
            'nama_pengirim.required' => 'Nama pengirim harus diisi',
            'nama_pengirim.max' => 'Nama pengirim maksimal 255 karakter',
            'masalah.required' => 'Masalah harus diisi',
            'masalah.min' => 'Masalah minimal 10 karakter',
            'lokasi.required' => 'Lokasi harus diisi',
            'lokasi.max' => 'Lokasi maksimal 255 karakter',
        ]);

        // Simpan ke database
        Pengaduan::create($validated);

        return redirect()->back()->with('success', 'Pengaduan Anda telah berhasil disampaikan. Terima kasih atas masukan Anda.');
    }

    /**
     * Menampilkan daftar pengaduan (untuk admin)
     */
    public function adminIndex()
    {
        $pengaduan = Pengaduan::orderBy('created_at', 'desc')->get();
        return view('pengaduan.admin-index', ['pengaduan' => $pengaduan]);
    }

    /**
     * Menampilkan detail pengaduan (untuk admin)
     */
    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pengaduan.admin-show', ['pengaduan' => $pengaduan]);
    }

    /**
     * Menampilkan riwayat pengaduan (untuk warga)
     */
    public function riwayat()
    {
        $pengaduan = Pengaduan::orderBy('created_at', 'desc')->get();
        return view('pengaduan.riwayat', ['pengaduan' => $pengaduan]);
    }
}

