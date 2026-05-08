<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Perpustakaan Premium')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        /* ===== PREMIUM LAYOUT SYSTEM ===== */
        :root {
            --sidebar-w: 272px;
            --sidebar-collapsed: 78px;
            --navbar-h: 72px;
            --accent: 139, 92, 246;
            --accent2: 168, 85, 247;
            --surface: 15, 23, 42;
        }

        /* SIDEBAR */
        .premium-sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            padding: 24px 16px;
            background: linear-gradient(180deg, #0c0e1a 0%, #0a0c18 50%, #080a14 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.06);
            overflow-y: auto;
            overflow-x: hidden;
            transition: width 0.35s cubic-bezier(.4, 0, .2, 1), padding 0.35s cubic-bezier(.4, 0, .2, 1);
        }

        .premium-sidebar::-webkit-scrollbar {
            width: 3px;
        }

        .premium-sidebar::-webkit-scrollbar-thumb {
            background: rgba(139, 92, 246, 0.3);
            border-radius: 10px;
        }

        /* Logo */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 8px 12px;
            margin-bottom: 28px;
            text-decoration: none;
        }

        .sidebar-brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, #8b5cf6, #a855f7, #c084fc);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #fff;
            box-shadow: 0 0 28px rgba(var(--accent), 0.35);
            flex-shrink: 0;
            transition: transform 0.3s;
        }

        .sidebar-brand:hover .sidebar-brand-icon {
            transform: rotate(-8deg) scale(1.08);
        }

        .sidebar-brand-text h2 {
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .sidebar-brand-text span {
            font-size: 11px;
            color: rgba(167, 139, 250, 0.6);
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-weight: 500;
        }

        /* Section label */
        .sidebar-section {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: rgba(148, 163, 184, 0.5);
            padding: 16px 14px 8px;
            font-weight: 600;
        }

        /* Nav items */
        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 14px;
            border-radius: 14px;
            color: #8892a6;
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            transition: all 0.25s cubic-bezier(.4, 0, .2, 1);
            border: 1px solid transparent;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 15px;
            transition: color 0.25s, transform 0.25s;
        }

        .nav-item:hover {
            color: #e2e8f0;
            background: rgba(var(--accent), 0.06);
            border-color: rgba(var(--accent), 0.08);
        }

        .nav-item:hover i {
            color: #a78bfa;
            transform: scale(1.12);
        }

        .nav-item.active {
            color: #fff;
            background: rgba(var(--accent), 0.12);
            border-color: rgba(var(--accent), 0.18);
            box-shadow: 0 0 24px rgba(var(--accent), 0.12), inset 0 0 0 1px rgba(var(--accent), 0.08);
        }

        .nav-item.active i {
            color: #a78bfa;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: -16px;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            border-radius: 0 4px 4px 0;
            background: linear-gradient(180deg, #8b5cf6, #a855f7);
            box-shadow: 0 0 12px rgba(var(--accent), 0.5);
        }

        /* Sidebar divider */
        .sidebar-divider {
            border: none;
            height: 1px;
            margin: 12px 14px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.06), transparent);
        }

        /* Sidebar footer */
        .sidebar-footer {
            margin-top: auto;
            padding-top: 16px;
        }

        .sidebar-user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.25s;
        }

        .sidebar-user-card:hover {
            background: rgba(var(--accent), 0.06);
            border-color: rgba(var(--accent), 0.12);
        }

        .sidebar-avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            box-shadow: 0 0 16px rgba(var(--accent), 0.2);
        }

        .sidebar-user-info {
            overflow: hidden;
            flex: 1;
        }

        .sidebar-user-info p {
            font-size: 13px;
            font-weight: 600;
            color: #e2e8f0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-info span {
            font-size: 11px;
            color: #64748b;
        }

        .nav-item.logout-item {
            color: #f87171;
            margin-top: 8px;
        }

        .nav-item.logout-item:hover {
            background: rgba(248, 113, 113, 0.08);
            border-color: rgba(248, 113, 113, 0.12);
            color: #fca5a5;
        }

        .nav-item.logout-item i {
            color: #f87171;
        }

        /* NAVBAR */
        .premium-navbar {
            margin-left: var(--sidebar-w);
            height: var(--navbar-h);
            position: sticky;
            top: 0;
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            background: rgba(10, 12, 24, 0.82);
            backdrop-filter: blur(20px) saturate(1.4);
            -webkit-backdrop-filter: blur(20px) saturate(1.4);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            transition: margin-left 0.35s cubic-bezier(.4, 0, .2, 1);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .navbar-left .page-title {
            font-size: 16px;
            font-weight: 600;
            color: #e2e8f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-left .page-title i {
            color: #a78bfa;
            font-size: 14px;
        }

        .navbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #64748b;
        }

        .navbar-breadcrumb a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s;
        }

        .navbar-breadcrumb a:hover {
            color: #a78bfa;
        }

        .navbar-breadcrumb .separator {
            color: #334155;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Navbar search */
        .navbar-search {
            position: relative;
        }

        .navbar-search input {
            width: 220px;
            padding: 9px 14px 9px 38px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            background: rgba(255, 255, 255, 0.04);
            color: #e2e8f0;
            font-size: 13px;
            outline: none;
            transition: all 0.3s;
        }

        .navbar-search input::placeholder {
            color: #475569;
        }

        .navbar-search input:focus {
            border-color: rgba(var(--accent), 0.3);
            background: rgba(255, 255, 255, 0.06);
            box-shadow: 0 0 20px rgba(var(--accent), 0.08);
            width: 280px;
        }

        .navbar-search i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            color: #475569;
        }

        /* Notification bell */
        .navbar-icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: #8892a6;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.25s;
            position: relative;
        }

        .navbar-icon-btn:hover {
            background: rgba(var(--accent), 0.08);
            color: #a78bfa;
            border-color: rgba(var(--accent), 0.15);
        }

        .navbar-icon-btn .notif-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #f43f5e;
            box-shadow: 0 0 8px rgba(244, 63, 94, 0.5);
        }

        /* Navbar profile */
        .navbar-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px 6px 6px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            cursor: pointer;
            transition: all 0.25s;
            position: relative;
        }

        .navbar-profile:hover {
            background: rgba(var(--accent), 0.06);
            border-color: rgba(var(--accent), 0.12);
        }

        .navbar-profile-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
        }

        .navbar-profile-name {
            font-size: 13px;
            font-weight: 500;
            color: #cbd5e1;
        }

        .navbar-profile .chevron {
            font-size: 10px;
            color: #64748b;
            transition: transform 0.2s;
        }

        /* Dropdown */
        .profile-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 200px;
            padding: 8px;
            background: rgba(15, 20, 35, 0.97);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: all 0.25s cubic-bezier(.4, 0, .2, 1);
            z-index: 200;
        }

        .navbar-profile.open .profile-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .navbar-profile.open .chevron {
            transform: rotate(180deg);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
            text-align: left;
        }

        .dropdown-item:hover {
            background: rgba(var(--accent), 0.08);
            color: #e2e8f0;
        }

        .dropdown-item i {
            width: 16px;
            text-align: center;
            font-size: 13px;
        }

        .dropdown-divider {
            height: 1px;
            margin: 4px 10px;
            background: rgba(255, 255, 255, 0.06);
        }

        .dropdown-item.danger {
            color: #f87171;
        }

        .dropdown-item.danger:hover {
            background: rgba(248, 113, 113, 0.08);
            color: #fca5a5;
        }

        /* MAIN */
        .premium-main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            transition: margin-left 0.35s cubic-bezier(.4, 0, .2, 1);
        }

        .premium-content {
            padding: 32px;
        }

        /* Header slot */
        .premium-header-slot {
            padding: 28px 32px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(255, 255, 255, 0.015);
        }

        /* Mobile toggle */
        .mobile-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: #8892a6;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.25s;
        }

        .mobile-toggle:hover {
            background: rgba(var(--accent), 0.08);
            color: #a78bfa;
        }

        /* Mobile overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 99;
        }

        /* Pulse animation for active indicator */
        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 12px rgba(var(--accent), 0.5);
            }

            50% {
                box-shadow: 0 0 20px rgba(var(--accent), 0.8);
            }
        }

        .nav-item.active::before {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .premium-sidebar {
                transform: translateX(-100%);
                box-shadow: 20px 0 60px rgba(0, 0, 0, 0.5);
            }

            .premium-sidebar.open {
                transform: translateX(0);
            }

            .premium-navbar,
            .premium-main {
                margin-left: 0;
            }

            .mobile-toggle {
                display: flex;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .navbar-search input {
                width: 160px;
            }

            .navbar-search input:focus {
                width: 200px;
            }
        }

        @media (max-width: 640px) {
            .premium-navbar {
                padding: 0 16px;
            }

            .premium-content {
                padding: 20px 16px;
            }

            .premium-header-slot {
                padding: 20px 16px;
            }

            .navbar-search {
                display: none;
            }

            .navbar-profile-name {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-slate-950 text-slate-100">
    <div class="min-h-screen">

        <!-- SIDEBAR OVERLAY (mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        <!-- ===== SIDEBAR ===== -->
        <aside class="premium-sidebar" id="sidebar">
            <!-- Brand -->
            <a href="<?php echo e(route('dashboard')); ?>" class="sidebar-brand">
                <div class="sidebar-brand-icon" style="background: none; box-shadow: none; padding: 0; overflow: hidden;">
                    <img src="<?php echo e(asset('images/nexa-library-logo.png')); ?>" alt="Nexa Library" style="width: 44px; height: 44px; object-fit: contain; border-radius: 14px;">
                </div>
                <div class="sidebar-brand-text">
                    <h2>Nexa Library</h2>
                    <span>Library System</span>
                </div>
            </a>

            <!-- Navigation -->
            <div class="sidebar-section">Menu Utama</div>
            <nav class="sidebar-nav">
                <a href="<?php echo e(route('dashboard')); ?>"
                    class="nav-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-grid-2"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?php echo e(route('siswas.index')); ?>"
                    class="nav-item <?php echo e(request()->routeIs('siswas*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-users"></i>
                    <span>Siswa</span>
                </a>
                <a href="<?php echo e(route('kategoris.index')); ?>"
                    class="nav-item <?php echo e(request()->routeIs('kategoris*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-tags"></i>
                    <span>Kategori</span>
                </a>
                <a href="<?php echo e(route('bukus.index')); ?>"
                    class="nav-item <?php echo e(request()->routeIs('bukus*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-book"></i>
                    <span>Buku</span>
                </a>
            </nav>

            <hr class="sidebar-divider">

            <div class="sidebar-section">Transaksi</div>
            <nav class="sidebar-nav">
                <a href="<?php echo e(route('peminjamans.index')); ?>"
                    class="nav-item <?php echo e(request()->routeIs('peminjamans*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-arrow-right-arrow-left"></i>
                    <span>Peminjaman</span>
                </a>
            </nav>

            <!-- Footer -->
            <div class="sidebar-footer">
                <hr class="sidebar-divider">
                <div class="sidebar-user-card">
                    <div class="sidebar-avatar"><?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?></div>
                    <div class="sidebar-user-info">
                        <p><?php echo e(Auth::user()->name); ?></p>
                        <span><?php echo e(Auth::user()->email); ?></span>
                    </div>
                </div>
                <form method="POST" action="<?php echo e(route('logout')); ?>" id="logoutForm">
                    <?php echo csrf_field(); ?>
                    <a href="#" class="nav-item logout-item"
                        onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </div>
        </aside>

        <!-- ===== NAVBAR ===== -->
        <div class="premium-navbar" id="navbar">
            <div class="navbar-left">
                <button class="mobile-toggle" onclick="toggleSidebar()">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="navbar-breadcrumb">
                    <a href="<?php echo e(route('dashboard')); ?>"><i class="fa-solid fa-house" style="font-size:11px;"></i></a>
                    <span class="separator">/</span>
                    <span style="color:#cbd5e1;">
                        <?php if(request()->routeIs('dashboard')): ?>
                            Dashboard
                        <?php elseif(request()->routeIs('siswas*')): ?>
                            Siswa
                        <?php elseif(request()->routeIs('kategoris*')): ?>
                            Kategori
                        <?php elseif(request()->routeIs('bukus*')): ?>
                            Buku
                        <?php elseif(request()->routeIs('peminjamans*')): ?>
                            Peminjaman
                        <?php else: ?>
                            Halaman
                        <?php endif; ?>
                    </span>
                </div>
            </div>

            <div class="navbar-right">
                <div class="navbar-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari sesuatu...">
                </div>

                <div class="navbar-icon-btn">
                    <i class="fa-regular fa-bell"></i>
                    <div class="notif-dot"></div>
                </div>

                <div class="navbar-profile" id="profileBtn" onclick="toggleProfile()">
                    <div class="navbar-profile-avatar"><?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?></div>
                    <span class="navbar-profile-name"><?php echo e(Auth::user()->name); ?></span>
                    <i class="fa-solid fa-chevron-down chevron"></i>

                    <!-- Dropdown -->
                    <div class="profile-dropdown">
                        <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                            <i class="fa-regular fa-user"></i> Profil Saya
                        </a>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item danger"
                            onclick="event.stopPropagation(); document.getElementById('logoutForm').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i> Keluar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== MAIN CONTENT ===== -->
        <div class="premium-main" id="mainContent">
            <?php if(isset($header)): ?>
                <div class="premium-header-slot">
                    <?php echo e($header); ?>

                </div>
            <?php endif; ?>

            <div class="premium-content">
                <?php echo e($slot); ?>

            </div>
        </div>

    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }

        function toggleProfile() {
            document.getElementById('profileBtn').classList.toggle('open');
        }
        // Close profile dropdown on outside click
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('profileBtn');
            if (btn && !btn.contains(e.target)) {
                btn.classList.remove('open');
            }
        });
    </script>

    <!-- SweetAlert Flash Messages -->
    <script>
        // Show success toast from Laravel session flash
        <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?php echo e(session('success')); ?>',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#1e1b4b',
                color: '#e2e8f0',
                iconColor: '#34d399',
            });
        <?php endif; ?>

        // Global AJAX delete with SweetAlert
        function confirmDelete(url, rowId) {
            Swal.fire({
                title: 'Yakin hapus data ini?',
                text: 'Data yang dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: '#1e1b4b',
                color: '#e2e8f0',
                customClass: {
                    popup: 'rounded-2xl border border-white/10',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json().then(data => ({
                            ok: response.ok,
                            data
                        })))
                        .then(({
                            ok,
                            data
                        }) => {
                            if (ok && data.success) {
                                const row = document.getElementById(rowId);
                                if (row) {
                                    row.style.transition = 'all 0.4s ease';
                                    row.style.opacity = '0';
                                    row.style.transform = 'translateX(40px)';
                                    setTimeout(() => row.remove(), 400);
                                }
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: data.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 2500,
                                    timerProgressBar: true,
                                    background: '#1e1b4b',
                                    color: '#e2e8f0',
                                    iconColor: '#34d399',
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Tidak Bisa Dihapus!',
                                    text: data.message || 'Data ini masih digunakan di tabel lain.',
                                    background: '#1e1b4b',
                                    color: '#e2e8f0',
                                    confirmButtonColor: '#8b5cf6',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus.',
                                background: '#1e1b4b',
                                color: '#e2e8f0',
                            });
                        });
                }
            });
        }
    </script>
</body>

</html>
<?php /**PATH C:\Users\Danan\Downloads\TUGAS-MIGRATION4\TUGAS-MIGRATION\resources\views/layouts/app.blade.php ENDPATH**/ ?>