<header id="main-header">
    <div class="header-inner">
        <!-- Logo -->
        <a href="/" class="header-logo">
            <img src="/assets/images/logo.png" alt="Bánh Trung Thu" />
        </a>

        <!-- Nav desktop -->
        <nav class="header-nav">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Trang chủ</a>
            <a href="/gioi-thieu" class="{{ request()->is('gioi-thieu') ? 'active' : '' }}">Giới thiệu</a>
            <a href="/san-pham" class="{{ request()->is('san-pham*') ? 'active' : '' }}">Sản phẩm</a>
            <a href="/lien-he" class="{{ request()->is('lien-he') ? 'active' : '' }}">Liên hệ</a>
        </nav>

        <!-- Right -->
        <div class="header-right">
            <a href="tel:0966859061" class="header-phone">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span>0966 859 061</span>
            </a>

            <button class="header-icon-btn" onclick="toggleSearch()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>

            <a href="/dang-nhap" class="header-icon-btn" id="login-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </a>

            <a href="/gio-hang" class="header-icon-btn cart-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span class="cart-count" id="cart-count">0</span>
            </a>

            <div class="lang-flags">
                <button class="lang-btn active" onclick="setLang('vi')">
                    <img src="https://flagcdn.com/w40/vn.png" alt="VI" />
                </button>
                <button class="lang-btn" onclick="setLang('zh')">
                    <img src="https://flagcdn.com/w40/cn.png" alt="CN" />
                </button>
                <button class="lang-btn" onclick="setLang('ja')">
                    <img src="https://flagcdn.com/w40/jp.png" alt="JP" />
                </button>
                <button class="lang-btn" onclick="setLang('en')">
                    <img src="https://flagcdn.com/w40/gb.png" alt="EN" />
                </button>
            </div>

            <button class="hamburger" onclick="toggleMobileMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Search bar -->
    <div id="search-bar">
        <div class="search-inner">
            <form action="/san-pham" method="GET" style="display:flex;gap:8px;flex:1;">
                <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." value="{{ request('keyword') }}" />
                <button type="submit">Tìm</button>
            </form>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu">
        <nav>
            <a href="/">Trang chủ</a>
            <a href="/gioi-thieu">Giới thiệu</a>
            <a href="/san-pham">Sản phẩm</a>
            <a href="/lien-he">Liên hệ</a>
            <a href="/dang-nhap">Đăng nhập</a>
        </nav>
    </div>
</header>