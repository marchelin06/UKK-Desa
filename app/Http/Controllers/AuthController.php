<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * --------------------------
     * TAMPIL FORM LOGIN USER
     * --------------------------
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * --------------------------
     * PROSES LOGIN USER
     * --------------------------
     */
    public function login(Request $request)
    {

      
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.'
        ]);

        
        // Kredensial Login
        $credentials = $request->only('email', 'password');


        // Pastikan hanya role warga yang bisa login menggunakan AuthController
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
       
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.dashboard')
                ->with('success', 'Login berhasil!');
            }

            // Cek apakah NIK dan No HP sudah dilengkapi
            if (Auth::user()->nik == null || Auth::user()->no_hp == null) {
                return redirect()->route('profile.edit')
                    ->with('info', 'Silakan lengkapi data diri Anda terlebih dahulu.');
            }

            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah, atau Anda bukan pengguna warga.'
        ])->withInput();
    }

    /**
     * --------------------------
     * TAMPIL FORM REGISTER
     * --------------------------
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * --------------------------
     * PROSES REGISTER USER
     * --------------------------
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'warga', // default
        ]);

        return redirect()->route('login.user')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * --------------------------
     * LOGOUT
     * --------------------------
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Anda telah logout.');
    }
}