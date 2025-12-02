@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<section class="hero">
    <div class="hero-text">
        <h1>Selamat Datang di Sistem Informasi Desa</h1>
        <p>Kelola data desa, layanan masyarakat, dan informasi penting secara mudah, cepat, dan terintegrasi.</p>
        @guest
            <a href="{{ route('register') }}" class="btn-green">Mulai Sekarang</a>
        @endguest
    </div>
    <img src="{{ asset('images/logo-sidoarjo.png') }}" alt="Logo Sidoarjo" style="width:50vmin;">
</section>
@endsection

