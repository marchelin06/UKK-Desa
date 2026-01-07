<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistem Informasi Desa')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        nav.sidebar,
        footer, 
        section.hero .hero-text a {
            background : darkgreen !important;
        }

        body {
            background: linear-gradient(135deg, #e8f5e9 0%, #f1f8f5 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }

        .app-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: row;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            box-shadow: 4px 0 12px rgba(27, 94, 32, 0.2);
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-260px);
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-logo {
            height: 40px;
            width: auto;
        }

        .sidebar-title {
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            margin: 0;
        }

        .sidebar-nav {
            list-style: none;
            padding: 15px 0;
            margin: 0;
            padding-bottom: 130px;
        }

        .sidebar-nav li {
            margin: 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.1);
            color: #a5d6a7;
            border-left-color: #a5d6a7;
            padding-left: 18px;
        }

        .sidebar-nav i {
            width: 20px;
            text-align: center;
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 10px 0;
        }

        .sidebar-profile {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 260px;
            background: rgba(0, 0, 0, 0.2);
            padding: 15px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 999;
        }

        .profile-avatar {
            font-size: 32px;
            color: #a5d6a7;
            min-width: 32px;
        }

        .profile-info {
            flex: 1;
            min-width: 0;
        }

        .profile-name {
            margin: 0;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .profile-role {
            margin: 4px 0 0 0;
            font-size: 11px;
        }

        .badge-admin {
            background: #66bb6a;
            color: #fff;
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-user {
            background: #43a047;
            color: #fff;
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .toggle-sidebar {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 18px;
        }

        .app-content {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .app-footer {
            text-align: center;
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: #ffffff;
            padding: 12px 10px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                max-width: 260px;
            }

            .sidebar.collapsed {
                transform: translateX(-100%);
            }

            .app-content {
                margin-left: 0;
            }

            .toggle-sidebar {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        /* Styles untuk layanan modal */
        .services-modal-content {
            border-radius: 16px;
            border: none;
        }

        .services-modal-header {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
            border: none;
        }

        .services-modal-header .btn-close {
            filter: invert(1);
        }

        .services-grid-modal {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            padding: 20px;
        }

        .service-card-modal {
            border-radius: 12px;
            border: 2px solid #e8f5e9;
            padding: 16px;
            background: linear-gradient(135deg, #f9fbf7 0%, #f1f8f5 100%);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .service-card-modal:hover {
            border-color: #43a047;
            box-shadow: 0 8px 20px rgba(67, 160, 71, 0.2);
            transform: translateY(-4px);
        }

        .service-icon {
            font-size: 32px;
            color: #1b5e20;
            margin-bottom: 8px;
        }

        .service-name {
            font-size: 14px;
            font-weight: 600;
            color: #1b5e20;
        }

        .btn-green {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
            border-radius: 30px;
            padding: 12px 28px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 12px rgba(27, 94, 32, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .btn-green:hover {
            background: linear-gradient(135deg, #145c42 0%, #1b5e20 100%);
            color: #fff;
            box-shadow: 0 6px 18px rgba(27, 94, 32, 0.4);
            transform: translateY(-2px);
        }

        /* Hero section (dipakai kalau beranda butuh) */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 100px 10%;
            background: linear-gradient(135deg, rgba(46, 125, 50, 0.05) 0%, rgba(67, 160, 71, 0.05) 100%);
        }
        .hero-text {
            max-width: 50%;
        }
        .hero-text h1 {
            font-size: 48px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 15px;
        }
        .hero-text p {
            font-size: 18px;
            color: #555;
            margin: 20px 0;
            line-height: 1.6;
        }
        .hero img {
            width: 420px;
            height: auto;
        }
        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
                padding: 60px 20px;
            }
            .hero-text {
                max-width: 100%;
            }
            .hero img {
                margin-top: 30px;
            }
        }

        /* Utility umum (card dan tombol utama) */
        .card-custom {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(27, 94, 32, 0.1);
            border: 1px solid rgba(67, 160, 71, 0.1);
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            box-shadow: 0 12px 32px rgba(27, 94, 32, 0.15);
            transform: translateY(-4px);
        }

        .btn-primary-rounded {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(27, 94, 32, 0.3);
        }

        .btn-primary-rounded:hover {
            background: linear-gradient(135deg, #145c42 0%, #1b5e20 100%);
            color: #fff;
            box-shadow: 0 6px 18px rgba(27, 94, 32, 0.4);
            transform: translateY(-2px);
        }

        /* Smooth transitions */
        a, button {
            transition: all 0.3s ease;
        }
    </style>

    @stack('styles')
</head>
<body>
<div class="app-wrapper">

    {{-- Sidebar Navigation --}}
    @include('layouts.navbar')

    {{-- Main Content Area --}}
    <div class="app-content">
        {{-- Konten halaman --}}
        <main style="flex: 1;">
            @yield('content')
        </main>

        {{-- Footer global --}}
        <footer class="app-footer">
            <p class="mb-0">&copy; {{ date('Y') }} Sistem Informasi Desa Bangah. Semua Hak Dilindungi.</p>
        </footer>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Toggle sidebar on mobile
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.querySelector('.toggle-sidebar');
        
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                sidebar.classList.toggle('collapsed');
            });
        }

        // Close sidebar when clicking on a link
        const sidebarLinks = document.querySelectorAll('.sidebar-nav a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('collapsed');
                }
            });
        });
    });
</script>

@stack('scripts')
</body>
</html>
