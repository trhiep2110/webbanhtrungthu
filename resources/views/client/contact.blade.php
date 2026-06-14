@extends('layouts.app')

@section('content')

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/home-2.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Liên Hệ</h1>
        <p><a href="/">Trang chủ</a> / <span>Liên hệ</span></p>
    </div>
</section>

{{-- NỘI DUNG --}}
<section class="contact-section">
    <div class="container">
        <div class="contact-layout">

            {{-- THÔNG TIN LIÊN HỆ --}}
            <div class="contact-info">
                <p class="section-subtitle" style="text-align:left;">Liên hệ với chúng tôi</p>
                <h2 style="font-size:32px;font-weight:700;color:var(--dark);margin-top:8px;margin-bottom:24px;">
                    Chúng Tôi Luôn Sẵn Sàng Hỗ Trợ Bạn
                </h2>
                <p style="color:#4b5563;font-size:15px;line-height:1.8;margin-bottom:32px;">
                    Nếu bạn có bất kỳ câu hỏi nào về sản phẩm hoặc dịch vụ của chúng tôi, đừng ngần ngại liên hệ. Đội
                    ngũ của chúng tôi luôn sẵn sàng hỗ trợ bạn.
                </p>

                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4>Địa chỉ</h4>
                            <p>Số 1 Đại Cồ Việt, Hai Bà Trưng, Hà Nội</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h4>Số điện thoại</h4>
                            <p><a href="tel:0966859061">0966 859 061</a></p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4>Email</h4>
                            <p><a href="mailto:contact@banhtrungthu.vn">contact@banhtrungthu.vn</a></p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4>Giờ làm việc</h4>
                            <p>Thứ 2 - Thứ 7: 8:00 - 20:00</p>
                            <p>Chủ nhật: 9:00 - 18:00</p>
                        </div>
                    </div>
                </div>

                {{-- MẠNG XÃ HỘI --}}
                <div style="margin-top:32px;">
                    <h4 style="font-weight:600;color:var(--dark);margin-bottom:16px;">Theo dõi chúng tôi</h4>
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
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- FORM LIÊN HỆ --}}
            <div class="contact-form-box">
                <h3 style="font-size:22px;font-weight:700;color:var(--dark);margin-bottom:24px;">Gửi tin nhắn cho chúng
                    tôi</h3>

                <div id="contact-error" class="auth-alert auth-alert-error" style="display:none;"></div>
                <div id="contact-success" class="auth-alert auth-alert-success" style="display:none;"></div>

                <form onsubmit="handleContact(event)">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" id="contact-name" class="form-input" placeholder="Nhập họ và tên"
                                required />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Số điện thoại</label>
                            <input type="tel" id="contact-phone" class="form-input" placeholder="Nhập số điện thoại"
                                required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" id="contact-email" class="form-input" placeholder="Nhập email" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nội dung</label>
                        <textarea id="contact-content" class="form-input" rows="5"
                            placeholder="Nhập nội dung tin nhắn..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-emerald" style="width:100%;" id="contact-btn">
                        Gửi tin nhắn
                    </button>
                </form>
            </div>

        </div>

        {{-- BẢN ĐỒ --}}
        <div class="contact-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6426650038946!2d105.84132661489754!3d21.00737209358762!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac4359c5e85b%3A0xa2d5f2f83a83f0bb!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIC0gxJDH!5e0!3m2!1svi!2svn!4v1625000000000!5m2!1svi!2svn"
                width="100%" height="400" style="border:0;border-radius:16px;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
async function handleContact(e) {
    e.preventDefault();
    const errorEl = document.getElementById('contact-error');
    const successEl = document.getElementById('contact-success');
    const btn = document.getElementById('contact-btn');

    errorEl.style.display = 'none';
    successEl.style.display = 'none';
    btn.textContent = 'Đang gửi...';
    btn.disabled = true;

    const res = await apiFetch('/contact', {
        method: 'POST',
        body: JSON.stringify({
            fullname: document.getElementById('contact-name').value,
            phone: document.getElementById('contact-phone').value,
            email: document.getElementById('contact-email').value,
            content: document.getElementById('contact-content').value,
        }),
    });

    if (res?.code === 200 || res?.code === 201) {
        successEl.textContent = 'Gửi tin nhắn thành công! Chúng tôi sẽ liên hệ lại sớm nhất.';
        successEl.style.display = 'block';
        e.target.reset();
    } else {
        errorEl.textContent = res?.message || 'Có lỗi xảy ra! Vui lòng thử lại.';
        errorEl.style.display = 'block';
    }

    btn.textContent = 'Gửi tin nhắn';
    btn.disabled = false;
}
</script>
@endpush