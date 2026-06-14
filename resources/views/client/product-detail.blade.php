@extends('layouts.app')

@section('content')

@php
$images = is_array($product->images) ? $product->images : json_decode($product->images, true);
$firstImg = $images[0] ?? '/assets/images/default.avif';
@endphp

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/product-filter.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Chi Tiết Sản Phẩm</h1>
        <p><a href="/">Trang chủ</a> / <a href="/san-pham">Sản phẩm</a> / <span>{{ $product->name }}</span></p>
    </div>
</section>

{{-- CHI TIẾT SẢN PHẨM --}}
<section class="product-detail-section">
    <div class="container">
        <div class="product-detail-layout">

            {{-- ẢNH SẢN PHẨM --}}
            <div class="product-detail-images">
                <div class="product-main-img">
                    <img id="main-img" src="{{ $firstImg }}" alt="{{ $product->name }}" />
                </div>
                @if(count($images) > 1)
                <div class="product-thumbnails">
                    @foreach($images as $img)
                    <img src="{{ $img }}" alt="{{ $product->name }}"
                        class="thumbnail {{ $loop->first ? 'active' : '' }}"
                        onclick="changeImage('{{ $img }}', this)" />
                    @endforeach
                </div>
                @endif
            </div>

            {{-- THÔNG TIN SẢN PHẨM --}}
            <div class="product-detail-info">
                <p class="product-detail-category">{{ $product->category->name ?? '' }}</p>
                <h1 class="product-detail-name">{{ $product->name }}</h1>

                {{-- ĐÁNH GIÁ --}}
                <div class="product-detail-rating">
                    <div class="product-stars">
                        @for($i = 1; $i <= 5; $i++) <svg
                            class="{{ $i <= round($product->ratings) ? 'star-filled' : 'star-empty' }}"
                            fill="currentColor" viewBox="0 0 20 20" style="width:20px;height:20px">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endfor
                    </div>
                    <span style="color:var(--gray);font-size:14px;">{{ $product->ratings }}/5
                        ({{ $product->comments->count() }} đánh giá)</span>
                </div>

                {{-- GIÁ --}}
                <div class="product-detail-price">
                    <p class="price-main">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                </div>

                {{-- TRẠNG THÁI --}}
                <div class="product-detail-status">
                    @if($product->in_stock)
                    <span class="status-badge status-instock">✓ Còn hàng</span>
                    @else
                    <span class="status-badge status-outstock">✗ Hết hàng</span>
                    @endif
                    <span class="status-badge status-brand">{{ $product->manufacturer->name ?? '' }}</span>
                </div>

                {{-- SỐ LƯỢNG & THÊM GIỎ --}}
                <div class="product-detail-actions">
                    <div class="quantity-box">
                        <button onclick="changeQty(-1)">−</button>
                        <input type="number" id="quantity" value="1" min="1" max="{{ $product->quantity }}" />
                        <button onclick="changeQty(1)">+</button>
                    </div>
                    <button class="btn btn-emerald" onclick="addToCartDetail({{ $product->id }})"
                        @if(!$product->in_stock) disabled @endif>
                        Thêm vào giỏ hàng
                    </button>
                    <button class="btn-favorite-detail" onclick="toggleFavorite({{ $product->id }}, this)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            style="width:24px;height:24px">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                </div>

                {{-- MÔ TẢ NGẮN --}}
                <div class="product-detail-desc">
                    <p>{{ Str::limit(strip_tags($product->description), 200) }}</p>
                </div>

                {{-- THÔNG TIN GIAO HÀNG --}}
                <div class="product-delivery-info">
                    <div class="delivery-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        <span>Giao hàng toàn quốc</span>
                    </div>
                    <div class="delivery-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>Đảm bảo chất lượng</span>
                    </div>
                    <div class="delivery-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <span>Thanh toán an toàn</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- MÔ TẢ CHI TIẾT & ĐÁNH GIÁ --}}
        <div class="product-tabs">
            <div class="tab-buttons">
                <button class="tab-btn active" onclick="switchTab('description', this)">Mô tả sản phẩm</button>
                <button class="tab-btn" onclick="switchTab('reviews', this)">Đánh giá
                    ({{ $product->comments->count() }})</button>
            </div>

            {{-- MÔ TẢ --}}
            <div id="tab-description" class="tab-content active">
                <div class="product-description">
                    {!! $product->description !!}
                </div>
            </div>

            {{-- ĐÁNH GIÁ --}}
            <div id="tab-reviews" class="tab-content">
                @if($product->comments->count() > 0)
                <div class="reviews-list">
                    @foreach($product->comments as $comment)
                    <div class="review-item">
                        <div class="review-user">
                            <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->fullname }}"
                                class="review-avatar" />
                            <div>
                                <p class="review-name">{{ $comment->user->fullname }}</p>
                                <div class="product-stars">
                                    @for($i = 1; $i <= 5; $i++) <svg
                                        class="{{ $i <= $comment->rating ? 'star-filled' : 'star-empty' }}"
                                        fill="currentColor" viewBox="0 0 20 20" style="width:14px;height:14px">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        @endfor
                                </div>
                                <p class="review-date">{{ $comment->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <p class="review-text">{{ $comment->content }}</p>
                    </div>
                    @endforeach
                </div>
                @else
                <p style="color:var(--gray);text-align:center;padding:40px 0;">Chưa có đánh giá nào!</p>
                @endif
            </div>
        </div>

        {{-- SẢN PHẨM LIÊN QUAN --}}
        @if($relatedProducts->count() > 0)
        <div class="related-products">
            <h2 class="section-title" style="text-align:left;font-size:28px;margin-bottom:24px;">Sản phẩm liên quan</h2>
            <div class="products-grid">
                @foreach($relatedProducts as $related)
                @php
                $relImages = is_array($related->images) ? $related->images : json_decode($related->images, true);
                $relImg = $relImages[0] ?? '/assets/images/default.avif';
                @endphp
                <div class="product-card">
                    <div class="product-img-wrap">
                        <a href="/san-pham/{{ $related->id }}">
                            <img src="{{ $relImg }}" alt="{{ $related->name }}" loading="lazy" />
                        </a>
                    </div>
                    <div class="product-info">
                        <p class="product-category">{{ $related->category->name ?? '' }}</p>
                        <a href="/san-pham/{{ $related->id }}" class="product-name">{{ $related->name }}</a>
                        <div class="product-bottom">
                            <p class="product-price">{{ number_format($related->price, 0, ',', '.') }}đ</p>
                            <button class="add-cart-btn" onclick="addToCart({{ $related->id }})">Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

@endsection

@push('scripts')
<script>
// ===== ĐỔI ẢNH =====
function changeImage(src, el) {
    document.getElementById('main-img').src = src;
    document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
}

// ===== SỐ LƯỢNG =====
function changeQty(delta) {
    const input = document.getElementById('quantity');
    const max = parseInt(input.max) || 99;
    let val = parseInt(input.value) + delta;
    if (val < 1) val = 1;
    if (val > max) val = max;
    input.value = val;
}

// ===== THÊM GIỎ CHI TIẾT =====
async function addToCartDetail(productId) {
    const quantity = parseInt(document.getElementById('quantity').value);
    const user = getUser();
    if (!user) {
        showToast('Vui lòng đăng nhập!', 'error');
        setTimeout(() => window.location.href = '/dang-nhap', 1500);
        return;
    }
    const res = await cartAPI.add(productId, quantity);
    if (res?.code === 200) {
        showToast('Đã thêm vào giỏ hàng!');
        updateCartCount();
    } else {
        showToast(res?.message || 'Có lỗi xảy ra!', 'error');
    }
}

// ===== SWITCH TAB =====
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    btn.classList.add('active');
}
</script>
@endpush