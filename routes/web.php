<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\FacadesAuth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KegiatanController;

// --------------------------
// BERANDA
// --------------------------
Route::get('/', function () {
    return view('beranda');
})->name('home');

// --------------------------
// LOGIN & REGISTER
// --------------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/login/admin', [AdminAuthController::class, 'loginForm'])->name('login.admin');
Route::post('/login/admin', [AdminAuthController::class, 'login'])->name('login.admin.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// --------------------------
// WARGA
// --------------------------
Route::middleware(['auth', 'role:warga'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard', ['user' => Auth::user()]);
    })->name('dashboard');

    // Surat untuk warga
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');

    // Inventaris (WARGA HANYA BISA LIHAT)
    Route::get('/inventaris', [InventarisController::class, 'publicIndex'])
        ->name('inventaris.public');
});

// --------------------------
// KEGIATAN (UNTUK SEMUA AUTHENTICATED USER)
// --------------------------
Route::middleware('auth')->group(function () {
    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/kegiatan/{kegiatan}', [KegiatanController::class, 'show'])->name('kegiatan.show');
});

// --------------------------
// ADMIN
// --------------------------
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('dashboard.admin', ['admin' => Auth::user()]);
    })->name('admin.dashboard');

    // Surat untuk admin
    Route::get('/admin/surat', [SuratController::class, 'adminIndex'])->name('admin.surat');

    // DETAIL SURAT + KEPUTUSAN
    Route::get('/admin/surat/{id}', [SuratController::class, 'show'])->name('admin.surat.show');
    Route::post('/admin/surat/{id}/keputusan', [SuratController::class, 'updateStatus'])->name('admin.surat.keputusan');

    // opsi cepat (kalau masih dipakai)
    Route::post('/admin/surat/{id}/setujui', [SuratController::class, 'setujui'])->name('admin.surat.setujui');
    Route::post('/admin/surat/{id}/tolak',   [SuratController::class, 'tolak'])->name('admin.surat.tolak');

    // MANAJEMEN INVENTARIS — CRUD khusus admin
    Route::get('/admin/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
    Route::get('/admin/inventaris/create', [InventarisController::class, 'create'])->name('inventaris.create');
    Route::post('/admin/inventaris', [InventarisController::class, 'store'])->name('inventaris.store');
    Route::get('/admin/inventaris/{id}', [InventarisController::class, 'show'])->name('inventaris.show');

    Route::get('/admin/inventaris/{id}/edit', [InventarisController::class, 'edit'])->name('inventaris.edit');
    Route::put('/admin/inventaris/{id}', [InventarisController::class, 'update'])->name('inventaris.update');

    Route::delete('/admin/inventaris/{id}', [InventarisController::class, 'destroy'])->name('inventaris.destroy');

    // MANAJEMEN PENGADUAN — ADMIN MELIHAT DAFTAR PENGADUAN
    Route::get('/admin/pengaduan', [PengaduanController::class, 'adminIndex'])->name('pengaduan.index');
    Route::get('/admin/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');

    // MANAJEMEN KEGIATAN — CRUD khusus admin
    Route::get('/admin/kegiatan', [KegiatanController::class, 'index'])->name('admin.kegiatan');
    Route::get('/admin/kegiatan/create', [KegiatanController::class, 'create'])->name('admin.kegiatan.create');
    Route::post('/admin/kegiatan', [KegiatanController::class, 'store'])->name('admin.kegiatan.store');
    Route::get('/admin/kegiatan/{kegiatan}', [KegiatanController::class, 'show'])->name('admin.kegiatan.show');
    Route::get('/admin/kegiatan/{kegiatan}/edit', [KegiatanController::class, 'edit'])->name('admin.kegiatan.edit');
    Route::put('/admin/kegiatan/{kegiatan}', [KegiatanController::class, 'update'])->name('admin.kegiatan.update');
    Route::delete('/admin/kegiatan/{kegiatan}', [KegiatanController::class, 'destroy'])->name('admin.kegiatan.destroy');
});

// --------------------------
// LAYANAN PUBLIK (WARGA)
// --------------------------

// Pengaduan - HANYA UNTUK WARGA
Route::middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/layanan/pengaduan', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/layanan/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/layanan/riwayat-pengaduan', [PengaduanController::class, 'riwayat'])->name('pengaduan.riwayat');
});

// --------------------------
// LOGOUT
// --------------------------
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --------------------------
// PROFILE (authenticated users only)
// --------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
