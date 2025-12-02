<button class="toggle-sidebar">
    <i class="fas fa-bars"></i>
</button>

<nav class="sidebar">
    {{-- Sidebar Header --}}
    <div class="sidebar-header">
        <img src="{{ asset('images/logo-sidoarjo.png') }}" alt="Logo" class="sidebar-logo">
        <p class="sidebar-title">Desa Bangah</p>
    </div>

    {{-- Sidebar Navigation --}}
    <ul class="sidebar-nav">
        {{-- Home/Beranda --}}
        <li>
            <a href="{{ route('home') }}" class="@if(request()->routeIs('home')) active @endif">
                <i class="fas fa-home"></i>
                <span>Beranda</span>
            </a>
        </li>

        {{-- Dashboard (only for authenticated users) --}}
        @auth
            <li>
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                   class="@if(request()->routeIs('dashboard', 'admin.dashboard')) active @endif">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @endauth

        <div class="sidebar-divider"></div>

        {{-- Layanan Publik Button (toggles modal) --}}
        <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#servicesModal">
                <i class="fas fa-cogs"></i>
                <span>Layanan Publik</span>
            </a>
        </li>

        <div class="sidebar-divider"></div>

        {{-- Authentication --}}
        @auth
            <li>
                <a href="{{ route('profile.show') }}">
                    <i class="fas fa-user-circle"></i>
                    <span>Profil</span>
                </a>
            </li>

            <li>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="width: 100%; text-align: left; background: none; border: none; padding: 12px 20px; color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 14px; font-weight: 500; cursor: pointer; transition: all 0.3s ease; border-left: 3px solid transparent; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </a>
            </li>

            <li>
                <a href="{{ route('register') }}">
                    <i class="fas fa-user-plus"></i>
                    <span>Register</span>
                </a>
            </li>
        @endauth
    </ul>
</nav>

{{-- Services Modal --}}
<div class="modal fade" id="servicesModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content services-modal-content">
            <div class="modal-header services-modal-header">
                <h5 class="modal-title">Layanan Publik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="services-grid-modal">
                    {{-- Surat Menyurat --}}
                    <a href="{{ auth()->check() ? (auth()->user()->role === 'warga' ? route('surat.index') : route('admin.surat')) : route('login') }}" class="service-card-modal">
                        <div class="service-icon">📄</div>
                        <div class="service-name">Surat Menyurat</div>
                    </a>

                    {{-- Kegiatan Desa --}}
                    <a href="{{ route('kegiatan.index') }}" class="service-card-modal">
                        <div class="service-icon">🎉</div>
                        <div class="service-name">Kegiatan Desa</div>
                    </a>

                    {{-- Inventaris --}}
                    <a href="{{ route('inventaris.public') }}" class="service-card-modal">
                        <div class="service-icon">🏛️</div>
                        <div class="service-name">Inventaris Desa</div>
                    </a>

                    {{-- Pengaduan --}}
                    <a href="{{ route('pengaduan.create') }}" class="service-card-modal">
                        <div class="service-icon">💬</div>
                        <div class="service-name">Pengaduan Masyarakat</div>
                    </a>

                    {{-- Informasi (Beranda) --}}
                    <a href="{{ route('home') }}" class="service-card-modal">
                        <div class="service-icon">📢</div>
                        <div class="service-name">Informasi & Pengumuman</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
