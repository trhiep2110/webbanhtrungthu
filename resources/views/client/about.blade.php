@extends('layouts.app')

@section('content')

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/home-1.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Giới Thiệu</h1>
        <p><a href="/">Trang chủ</a> / <span>Giới thiệu</span></p>
    </div>
</section>

{{-- SECTION 1: VỀ CHÚNG TÔI --}}
<section class="about-section">
    <div class="container">
        <div class="about-layout">
            <div class="about-image">
                <img src="/assets/images/homeReason.jpg" alt="Về chúng tôi" />
            </div>
            <div class="about-content">
                <p class="section-subtitle" style="text-align:left;">Câu chuyện của chúng tôi</p>
                <h2 style="font-size:36px;font-weight:700;color:var(--dark);margin-top:8px;line-height:1.3;">
                    Bánh Trung Thu Truyền Thống Từ Trái Tim
                </h2>
                <p style="color:#4b5563;font-size:16px;line-height:1.8;margin-top:20px;">
                    Chúng tôi là thương hiệu bánh Trung Thu truyền thống với hơn 20 năm kinh nghiệm. Mỗi chiếc bánh được
                    làm thủ công từ những nguyên liệu tươi ngon nhất, theo công thức gia truyền được lưu giữ qua nhiều
                    thế hệ.
                </p>
                <p style="color:#4b5563;font-size:16px;line-height:1.8;margin-top:16px;">
                    Với triết lý "Chất lượng là ưu tiên hàng đầu", chúng tôi cam kết mang đến những chiếc bánh Trung Thu
                    ngon nhất, đẹp nhất cho mọi gia đình Việt Nam trong dịp Tết Trung Thu.
                </p>

                <div class="about-stats">
                    <div class="about-stat">
                        <p class="stat-number">20+</p>
                        <p class="stat-label">Năm kinh nghiệm</p>
                    </div>
                    <div class="about-stat">
                        <p class="stat-number">50+</p>
                        <p class="stat-label">Loại bánh</p>
                    </div>
                    <div class="about-stat">
                        <p class="stat-number">10K+</p>
                        <p class="stat-label">Khách hàng tin tưởng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2: GIÁ TRỊ CỐT LÕI --}}
<section style="padding:56px 0;background:var(--gray-light);">
    <div class="container">
        <p class="section-subtitle">Giá trị cốt lõi</p>
        <h2 class="section-title">Tại Sao Chọn Chúng Tôi?</h2>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3>Chất Lượng Đảm Bảo</h3>
                <p>Nguyên liệu được chọn lọc kỹ càng, đảm bảo an toàn vệ sinh thực phẩm theo tiêu chuẩn quốc tế.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3>Làm Thủ Công</h3>
                <p>Mỗi chiếc bánh được làm thủ công tỉ mỉ bởi những người thợ lành nghề, mang đậm hương vị truyền thống.
                </p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3>Giao Hàng Nhanh</h3>
                <p>Đảm bảo giao hàng đúng hẹn, đóng gói cẩn thận để bánh luôn tươi ngon khi đến tay khách hàng.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3>Hỗ Trợ 24/7</h3>
                <p>Đội ngũ chăm sóc khách hàng luôn sẵn sàng hỗ trợ bạn mọi lúc, mọi nơi.</p>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3: ĐỘI NGŨ --}}
<section style="padding:56px 0;">
    <div class="container">
        <p class="section-subtitle">Con người</p>
        <h2 class="section-title">Đội Ngũ Của Chúng Tôi</h2>
        <div class="team-grid">
            <div class="team-card">
                <img src="/assets/images/chef1.jpg" alt="Chef 1" />
                <div class="team-info">
                    <h3>Nguyễn Văn An</h3>
                    <p>Bếp trưởng</p>
                </div>
            </div>
            <div class="team-card">
                <img src="/assets/images/chef2.jpg" alt="Chef 2" />
                <div class="team-info">
                    <h3>Trần Thị Bình</h3>
                    <p>Chuyên gia bánh dẻo</p>
                </div>
            </div>
            <div class="team-card">
                <img src="/assets/images/chef3.png" alt="Chef 3" />
                <div class="team-info">
                    <h3>Lê Minh Tuấn</h3>
                    <p>Chuyên gia bánh nướng</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection