<footer>
    <div class="container">
        <div class="footer-grid">
            <!-- Cột 1 -->
            <div>
                <a href="/" class="footer-logo">
                    <img src="/assets/images/logo.png" alt="Logo" />
                </a>
                <div class="footer-info">
                    <div class="footer-info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Số 1 Đại Cồ Việt, Hai Bà Trưng, Hà Nội</span>
                    </div>
                    <div class="footer-info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>0966 859 061</span>
                    </div>
                    <div class="footer-info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>contact@banhtrungthu.vn</span>
                    </div>
                </div>
            </div>

            <!-- Cột 2: Danh mục -->
            <div>
                <h3 class="footer-title">Danh mục</h3>
                <div class="footer-links">
                    @foreach(\App\Models\Category::all() as $cat)
                    <a href="/san-pham?category={{ $cat->id }}">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </div>

            <!-- Cột 3: Liên kết -->
            <div>
                <h3 class="footer-title">Liên kết</h3>
                <div class="footer-links">
                    <a href="/">Trang chủ</a>
                    <a href="/gioi-thieu">Giới thiệu</a>
                    <a href="/san-pham">Sản phẩm</a>
                    <a href="/lien-he">Liên hệ</a>
                    <a href="/dang-nhap">Đăng nhập</a>
                    <a href="/dang-ky">Đăng ký</a>
                </div>
            </div>

            <!-- Cột 4 -->
            <div>
                <h3 class="footer-title">Kết nối với chúng tôi</h3>
                <div class="footer-socials">
                    <a href="#" class="social-btn social-fb">
                        <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                        </svg>
                    </a>
                    <a href="#" class="social-btn social-yt">
                        <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58z" />
                            <polygon fill="#065f46" points="9.75,15.02 15.5,12 9.75,8.98" />
                        </svg>
                    </a>
                </div>
                <h3 class="footer-title" style="margin-top:16px;">Phương thức thanh toán</h3>
                <div class="payment-logos">
                    <img src="/assets/images/logoVnpay.png" alt="VNPay" />
                    <img src="/assets/images/logoMomo.png" alt="MoMo" />
                    <img src="/assets/images/logoZaloPay.png" alt="ZaloPay" />
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} Bánh Trung Thu. Tất cả quyền được bảo lưu.</p>
    </div>
</footer>