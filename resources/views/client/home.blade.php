@extends('layouts.app')

@section('content')

{{-- ===== BANNER ===== --}}
<section class="banner-section">
    <div id="banner-slider">
        <div class="banner-slide active" style="background-image: url('/assets/images/children-banner-1.png')"></div>
        <div class="banner-slide" style="background-image: url('/assets/images/children-banner-2.png')"></div>
        <div class="banner-slide" style="background-image: url('/assets/images/home-1.jpg')"></div>
    </div>
    <div class="banner-content">
        <h1>Bánh Trung Thu Truyền Thống</h1>
        <p>Hương vị đậm đà, tình thân gắn bó</p>
        <a href="/san-pham" class="btn btn-yellow" style="margin-top:20px;">Mua ngay</a>
    </div>
    <div class="banner-dots">
        <div class="banner-dot active" onclick="goToSlide(0)"></div>
        <div class="banner-dot" onclick="goToSlide(1)"></div>
        <div class="banner-dot" onclick="goToSlide(2)"></div>
    </div>
</section>

{{-- ===== SECTION 1: FEATURED ===== --}}
<section class="featured-section">
    <div class="container">
        <div class="featured-grid">
            <div class="featured-item featured-item-big">
                <div class="featured-bg" style="background-image: url('/assets/images/home-1.jpg');"></div>
                <div class="featured-overlay">
                    <h2>Bánh Nướng Truyền Thống</h2>
                    <p>Hương vị đậm đà từ ngàn xưa</p>
                    <a href="/san-pham" class="btn btn-white">Mua ngay</a>
                </div>
            </div>
            <div class="featured-item">
                <div class="featured-bg" style="background-image: url('/assets/images/home-2.jpg');"></div>
                <div class="featured-overlay">
                    <h2>Bánh Dẻo Mềm</h2>
                    <a href="/san-pham" class="btn btn-white" style="margin-top:8px;">Mua ngay</a>
                </div>
            </div>
            <div class="featured-item">
                <div class="featured-bg" style="background-image: url('/assets/images/popularDish-1.jpg');"></div>
                <div class="featured-overlay">
                    <h2>Hộp Quà Sang Trọng</h2>
                    <a href="/san-pham" class="btn btn-white" style="margin-top:8px;">Mua ngay</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== SECTION 2: SẢN PHẨM PHỔ BIẾN ===== --}}
<section class="popular-section" style="background-image: url('/assets/images/product-filter.jpg')">
    <div class="container">
        <p class="section-subtitle">Tết Trung Thu</p>
        <h2 class="section-title">Sản Phẩm Phổ Biến</h2>
        <div class="products-grid" id="popular-products">
            {{-- Skeleton loading --}}
            @for($i = 0; $i < 4; $i++) <div class="product-card"
                style="min-height:300px; background: linear-gradient(90deg,#f0f0f0 25%,#e0e0e0 50%,#f0f0f0 75%); background-size:200% 100%; animation: shimmer 1.5s infinite;">
        </div>
        @endfor
    </div>
    <div style="text-align:center; margin-top:40px;">
        <a href="/san-pham" class="btn btn-emerald">Xem tất cả sản phẩm</a>
    </div>
    </div>
</section>

{{-- ===== SECTION 3: LÝ DO CHỌN CHÚNG TÔI ===== --}}
<section class="reason-section">
    <div class="container">
        <div class="reason-inner">
            <div class="reason-img">
                <img src="/assets/images/homeReason.jpg" alt="Lý do chọn chúng tôi" />
            </div>
            <div class="reason-content">
                <h3>Tại sao chọn chúng tôi?</h3>
                <h2>Chất Lượng Là Ưu Tiên Hàng Đầu</h2>
                <p>Chúng tôi cam kết mang đến những chiếc bánh Trung Thu chất lượng cao nhất, được làm từ nguyên liệu
                    tươi ngon, theo công thức truyền thống được lưu giữ qua nhiều thế hệ.</p>
                <p>Mỗi chiếc bánh là một tác phẩm nghệ thuật, mang trong đó tình cảm và sự tỉ mỉ của những người thợ làm
                    bánh lành nghề.</p>
                <div class="reason-features">
                    <div class="reason-feature">
                        <div class="reason-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p>Nguyên liệu tự nhiên</p>
                    </div>
                    <div class="reason-feature">
                        <div class="reason-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p>Giao hàng nhanh chóng</p>
                    </div>
                    <div class="reason-feature">
                        <div class="reason-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <p>Làm thủ công tỉ mỉ</p>
                    </div>
                    <div class="reason-feature">
                        <div class="reason-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <p>Đa dạng hương vị</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== SECTION 4: ĐĂNG KÝ EMAIL ===== --}}
<section class="email-section" style="background-image: url('/assets/images/home-2.jpg')">
    <div class="email-overlay"></div>
    <div class="container email-content">
        <p>Tết Trung Thu</p>
        <h2>Đăng Ký Nhận Ưu Đãi Đặc Biệt</h2>
        <div class="email-form">
            <input type="email" id="email-input" placeholder="Nhập email của bạn..." />
            <button type="button" onclick="registerEmail()">Đăng ký</button>
        </div>
    </div>
</section>

{{-- ===== SECTION 5: ĐÁNH GIÁ KHÁCH HÀNG ===== --}}
<section class="comment-section" style="background-image: url('/assets/images/commentBg.png')">
    <div class="container">
        <p class="section-subtitle">Phản hồi từ khách hàng</p>
        <h2 class="section-title">Khách Hàng Nói Gì?</h2>
        <div class="comment-slider">
            <div class="comment-track" id="comment-track"></div>
        </div>
        <div class="comment-nav">
            <button onclick="prevComment()">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button onclick="nextComment()">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // ===== BANNER =====
    let currentSlide = 0;
    const slides = document.querySelectorAll('.banner-slide');
    const dots = document.querySelectorAll('.banner-dot');

    function goToSlide(index) {
        slides[currentSlide].classList.remove('active');
        dots[currentSlide].classList.remove('active');
        currentSlide = index;
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }
    setInterval(() => goToSlide((currentSlide + 1) % slides.length), 5000);

    // ===== LOAD PRODUCTS =====
    async function loadPopularProducts() {
        const res = await productAPI.getAll({
            limit: 4,
            page: 1
        });
        const products = res?.data?.products || [];
        const container = document.getElementById('popular-products');
        if (products.length === 0) {
            container.innerHTML =
                '<p style="text-align:center;color:#6b7280;grid-column:span 4;">Chưa có sản phẩm nào.</p>';
            return;
        }
        container.innerHTML = products.map(renderProductCard).join('');
    }

    // ===== COMMENTS =====
    const comments = [{
            name: 'Lê Công Nghĩa',
            comment: 'Bánh rất ngon và giá cả vô cùng hợp lý. Tôi đánh giá cao sự cẩn thận trong việc đóng gói và sự chu đáo của dịch vụ.',
            rating: 5
        },
        {
            name: 'Nguyễn Văn A',
            comment: 'Sản phẩm có chất lượng tuyệt vời, vượt qua mong đợi của tôi. Giao hàng nhanh chóng và đúng hẹn là một điểm cộng lớn.',
            rating: 5
        },
        {
            name: 'Trần Thị B',
            comment: 'Dịch vụ khách hàng thật sự xuất sắc. Tôi rất hài lòng với sản phẩm nhận được và sự hỗ trợ nhiệt tình.',
            rating: 4
        },
        {
            name: 'Hoàng Minh',
            comment: 'Bánh trung thu rất thơm ngon và có mùi vị đặc biệt. Packaging rất đẹp và sang trọng.',
            rating: 5
        },
        {
            name: 'Phạm Hồng',
            comment: 'Tôi thực sự ấn tượng với chất lượng của bánh. Sẽ tiếp tục ủng hộ và giới thiệu cho bạn bè.',
            rating: 4
        },
        {
            name: 'Vũ Thị Mai',
            comment: 'Sản phẩm đúng như mô tả. Giao hàng nhanh chóng và đóng gói rất cẩn thận.',
            rating: 5
        },
    ];

    let commentIndex = 0;

    function renderComments() {
        document.getElementById('comment-track').innerHTML = comments.map(c => `
        <div class="comment-card">
            <div class="comment-user">
                <div class="comment-avatar">${c.name.charAt(0)}</div>
                <div>
                    <p class="comment-name">${c.name}</p>
                    <div class="comment-stars">${renderStars(c.rating)}</div>
                </div>
            </div>
            <p class="comment-text">${c.comment}</p>
        </div>
    `).join('');
    }

    function getVisibleCount() {
        return window.innerWidth < 768 ? 1 : window.innerWidth < 1280 ? 2 : 3;
    }

    function nextComment() {
        const max = comments.length - getVisibleCount();
        if (commentIndex < max) {
            commentIndex++;
            updateCommentSlider();
        }
    }

    function prevComment() {
        if (commentIndex > 0) {
            commentIndex--;
            updateCommentSlider();
        }
    }

    function updateCommentSlider() {
        const card = document.querySelector('.comment-card');
        if (!card) return;
        const width = card.offsetWidth + 24;
        document.getElementById('comment-track').style.transform = `translateX(-${commentIndex * width}px)`;
    }

    // ===== EMAIL =====
    function registerEmail() {
        const input = document.getElementById('email-input');
        if (!input.value || !input.value.includes('@')) {
            showToast('Vui lòng nhập email hợp lệ!', 'error');
            return;
        }
        showToast('Đăng ký thành công! Cảm ơn bạn.');
        input.value = '';
    }

    // ===== INIT =====
    loadPopularProducts();
    renderComments();
</script>
@endpush