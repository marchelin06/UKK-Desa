<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil user
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', ['user' => $user]);
    }

    /**
     * Menampilkan form edit profil (untuk melengkapi NIK dan No HP)
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', ['user' => $user]);
    }

    /**
     * Update data profil user (NIK dan No HP)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nik'   => 'required|string|max:16|min:16|regex:/^[0-9]{16}$/',
            'no_hp' => 'required|string|max:20|min:10|regex:/^(\+62|0)[0-9]{9,18}$/',
        ], [
            'nik.required'        => 'NIK wajib diisi.',
            'nik.regex'           => 'NIK harus terdiri dari 16 digit angka.',
            'nik.min'             => 'NIK harus 16 digit.',
            'no_hp.required'      => 'Nomor HP wajib diisi.',
            'no_hp.regex'         => 'Format nomor HP tidak valid. Gunakan format 08xxxxx atau +62xxxxx.',
            'no_hp.min'           => 'Nomor HP minimal 10 digit.',
        ]);

        $user->update([
            'nik'   => $request->nik,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Data diri Anda berhasil disimpan!');
    }
}
