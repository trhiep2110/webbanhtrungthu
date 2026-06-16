<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Admin - Bánh Trung Thu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Main styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>

<body class="admin-body">

    <div class="admin-wrapper" id="admin-wrapper">

        {{-- ===== SIDEBAR ===== --}}
        <aside class="admin-sidebar" id="admin-sidebar">

            {{-- HEADER SIDEBAR --}}
            <div class="admin-sidebar-header">
                <a href="/admin" class="admin-sidebar-logo">
                    <img src="/assets/images/logo.png" alt="Logo" />
                    <span class="admin-sidebar-title">Nguyệt Việt</span>
                </a>
                <button class="admin-sidebar-toggle" onclick="toggleSidebar()" id="toggle-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                </button>
            </div>

            {{-- NAV MENU --}}
            <nav class="admin-nav">
                <a href="/admin" class="admin-nav-item {{ request()->is('admin') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Thống kê</span>
                </a>
                <a href="/admin/don-hang" class="admin-nav-item {{ request()->is('admin/don-hang*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>Danh sách đơn hàng</span>
                </a>
                <a href="/admin/nguoi-dung"
                    class="admin-nav-item {{ request()->is('admin/nguoi-dung*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Danh sách người dùng</span>
                </a>
                <a href="/admin/san-pham" class="admin-nav-item {{ request()->is('admin/san-pham*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Danh sách sản phẩm</span>
                </a>
                <a href="/admin/danh-muc" class="admin-nav-item {{ request()->is('admin/danh-muc*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span>Danh sách danh mục</span>
                </a>
                <a href="/admin/thuong-hieu"
                    class="admin-nav-item {{ request()->is('admin/thuong-hieu*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span>Danh sách thương hiệu</span>
                </a>
                <a href="/admin/kho-hang" class="admin-nav-item {{ request()->is('admin/kho-hang*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    <span>Quản lý kho hàng</span>
                </a>
                <a href="/admin/lien-he" class="admin-nav-item {{ request()->is('admin/lien-he*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>Danh sách liên hệ</span>
                </a>
                <a href="/admin/chat" class="admin-nav-item {{ request()->is('admin/chat*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M21 16c0 1.1-.9 2-2 2H7l-4 4V6a2 2 0 012-2h14a2 2 0 012 2v10z" />
                    </svg>
                    <span>Chat với người dùng</span>
                </a>
            </nav>

        </aside>

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="admin-main" id="admin-main">

            {{-- HEADER ADMIN --}}
            <header class="admin-header">
                <div class="admin-header-left">
                    <div id="admin-clock" style="font-size:18px;font-weight:600;color:white;"></div>
                    <div id="admin-date" style="font-size:13px;color:rgba(255,255,255,0.7);margin-top:2px;"></div>
                </div>
                <div class="admin-header-right">
                    <span style="color:white;font-size:15px;">Xin chào, <strong
                            id="admin-username">Admin</strong></span>
                    <img id="admin-avatar" src="/assets/images/default.avif" alt="Avatar"
                        style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid var(--yellow);" />
                    <button onclick="adminLogout()" class="admin-logout-btn">Đăng xuất</button>
                </div>
            </header>

            {{-- NỘI DUNG --}}
            <div class="admin-content">
                <div class="admin-content-inner">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>

    {{-- TOAST --}}
    <div id="toast" class="toast"></div>

    @stack('scripts')
    <script>
    // ===== CLOCK =====
    function updateClock() {
        const now = new Date();
        document.getElementById('admin-clock').textContent = now.toLocaleTimeString('vi-VN');
        document.getElementById('admin-date').textContent = now.toLocaleDateString('vi-VN', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }
    updateClock();
    setInterval(updateClock, 1000);

    // ===== TOGGLE SIDEBAR =====
    let sidebarExpanded = true;

    function toggleSidebar() {
        sidebarExpanded = !sidebarExpanded;
        const sidebar = document.getElementById('admin-sidebar');
        const main = document.getElementById('admin-main');
        const btn = document.getElementById('toggle-btn');
        if (sidebarExpanded) {
            sidebar.classList.remove('collapsed');
            main.classList.remove('expanded');
            btn.style.transform = 'rotate(0deg)';
        } else {
            sidebar.classList.add('collapsed');
            main.classList.add('expanded');
            btn.style.transform = 'rotate(180deg)';
        }
    }

    // ===== LOAD ADMIN USER =====
    function loadAdminUser() {
        const user = getUser();
        if (!user || user.role !== 'admin') {
            window.location.href = '/dang-nhap';
            return;
        }
        document.getElementById('admin-username').textContent = user.fullname;
        document.getElementById('admin-avatar').src = user.avatar || '/assets/images/default.avif';
    }

    function adminLogout() {
        authAPI.logout();
        localStorage.removeItem('access_token');
        localStorage.removeItem('user');
        window.location.href = '/dang-nhap';
    }

    loadAdminUser();
    </script>
</body>

</html>