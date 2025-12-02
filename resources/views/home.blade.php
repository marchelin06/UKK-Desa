@extends('layouts.app')

@section('content')
<nav class="bg-blue-700 text-white px-6 py-3 flex justify-between items-center shadow-md">
    <div class="text-xl font-semibold">
        <a href="{{ route('home') }}" class="hover:text-gray-200">Sistem Informasi Desa</a>
    </div>

    <ul class="flex space-x-6 items-center">
        <li><a href="{{ route('home') }}" class="hover:text-gray-200 font-semibold">🏠 Beranda</a></li>

        {{-- Dropdown Layanan Publik --}}
        <li class="relative group">
            <button class="hover:text-gray-200 flex items-center font-semibold">
                ⚙️ Layanan Publik
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <ul
                class="absolute hidden group-hover:block bg-white text-gray-700 mt-2 py-2 rounded-lg shadow-lg w-80 z-50">
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">📄 Pelayanan Surat-Menyurat Digital</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">🏠 Manajemen Inventaris Aset Desa</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">📢 Layanan Pengaduan Masyarakat</a></li>
            </ul>
        </li>
sa</a></li>
        {{-- Menu tambahan --}}
        <li><a href="{{ route('dashboard.warga') }}" class="hover:text-gray-200 font-semibold">📊 Dashboard</a></li>
        <li><a href="{{ route('login') }}" class="hover:text-gray-200 font-semibold">🔐 Login</a></li>
    </ul>
</nav>

{{-- Hero Section --}}
<section class="bg-gray-50 py-20 text-center">
    <h1 class="text-4xl font-bold text-blue-800 mb-4">Selamat Datang di Sistem Informasi Desa Bangah</h1>
    <p class="text-gray-700 text-lg max-w-3xl mx-auto leading-relaxed">
        Portal digital desa yang memudahkan warga untuk mengakses berbagai layanan publik secara cepat dan transparan.
        <br>
        Mari wujudkan pelayanan desa yang modern dan efisien!
    </p>

    <div class="mt-8">
        <a href="{{ route('login') }}" class="bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition">
            Masuk Sekarang
        </a>
    </div>
</section>

{{-- Informasi tambahan --}}
<section class="bg-white py-10">
    <div class="max-w-5xl mx-auto text-center">
        <h2 class="text-2xl font-bold text-blue-700 mb-6">Layanan Unggulan Desa Bangah</h2>
        <p class="text-gray-600">
            Nikmati kemudahan layanan seperti pengajuan surat digital, pelaporan aduan masyarakat, hingga informasi kegiatan desa terkini.
        </p>
    </div>
</section>

{{-- Footer --}}
<footer class="bg-blue-700 text-white text-center py-4 mt-12">
    &copy; {{ date('Y') }} Sistem Informasi Desa Bangah. All rights reserved.
</footer>
@endsection