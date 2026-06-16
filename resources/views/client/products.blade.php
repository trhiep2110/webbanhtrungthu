@extends('layouts.app')

@section('content')

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/product-filter.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Sản Phẩm</h1>
        <p><a href="/">Trang chủ</a> / <span>Sản phẩm</span></p>
    </div>
</section>

{{-- NỘI DUNG --}}
<section class="products-page">
    <div class="container">
        <div class="products-layout">

            {{-- SIDEBAR --}}
            <aside class="products-sidebar">

                {{-- TÌM KIẾM --}}
                <div class="sidebar-box">
                    <form action="/san-pham" method="GET">
                        <div class="sidebar-search">
                            <input type="text" name="keyword" placeholder="Tìm kiếm..."
                                value="{{ request('keyword') }}" />
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- DANH MỤC --}}
                <div class="sidebar-box">
                    <h3 class="sidebar-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Danh mục sản phẩm
                    </h3>
                    <ul class="sidebar-list">
                        <li>
                            <a href="/san-pham" class="{{ !request('category') ? 'active' : '' }}">
                                Tất cả
                            </a>
                        </li>
                        @foreach($categories as $cat)
                        <li>
                            <a href="/san-pham?category={{ $cat->id }}"
                                class="{{ request('category') == $cat->id ? 'active' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- GIÁ --}}
                <div class="sidebar-box">
                    <h3 class="sidebar-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Giá sản phẩm
                    </h3>
                    <form action="/san-pham" method="GET" class="price-filter">
                        @if(request('keyword'))
                        <input type="hidden" name="keyword" value="{{ request('keyword') }}" />
                        @endif
                        @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}" />
                        @endif
                        <div class="price-inputs">
                            <input type="number" name="min_price" placeholder="Giá tối thiểu"
                                value="{{ request('min_price') }}" />
                            <span>—</span>
                            <input type="number" name="max_price" placeholder="Giá tối đa"
                                value="{{ request('max_price') }}" />
                        </div>
                        <button type="submit" class="btn btn-emerald" style="width:100%;margin-top:12px;">Áp
                            dụng</button>
                    </form>
                </div>

                {{-- THƯƠNG HIỆU --}}
                <div class="sidebar-box">
                    <h3 class="sidebar-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Thương hiệu
                    </h3>
                    <ul class="sidebar-list">
                        @foreach($manufacturers as $m)
                        <li>
                            <a href="/san-pham?manufacturer={{ $m->id }}"
                                class="{{ request('manufacturer') == $m->id ? 'active' : '' }}">
                                {{ $m->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <img src="{{ asset('assets/images/product-filter.jpg') }}" alt="Banner">
            </aside>

            {{-- DANH SÁCH SẢN PHẨM --}}
            <div class="products-main">

                {{-- SORT BAR --}}
                <div class="sort-bar">
                    <p class="sort-count">Hiển thị {{ $products->count() }} / {{ $products->total() }} sản phẩm</p>
                    <div class="sort-buttons">
                        <a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'newest'])) }}"
                            class="sort-btn {{ !request('sort') || request('sort') == 'newest' ? 'active' : '' }}">Mới
                            nhất</a>
                        <a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'rating'])) }}"
                            class="sort-btn {{ request('sort') == 'rating' ? 'active' : '' }}">Đánh giá cao</a>
                        <a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'price_asc'])) }}"
                            class="sort-btn {{ request('sort') == 'price_asc' ? 'active' : '' }}">Giá tăng dần</a>
                        <a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'price_desc'])) }}"
                            class="sort-btn {{ request('sort') == 'price_desc' ? 'active' : '' }}">Giá giảm dần</a>
                    </div>
                </div>

                {{-- GRID SẢN PHẨM --}}
                @if($products->count() > 0)
                <div class="products-grid-2">
                    @foreach($products as $product)
                    @php
                    $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                    $firstImg = $images[0] ?? '/assets/images/default.avif';
                    @endphp
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <a href="/san-pham/{{ $product->id }}">
                                <img src="{{ $firstImg }}" alt="{{ $product->name }}" loading="lazy" />
                            </a>
                            <button class="product-favorite" onclick="toggleFavorite({{ $product->id }}, this)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" style="width:20px;height:20px">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                            @if(!$product->in_stock)
                            <div class="out-of-stock-overlay">
                                <span class="out-of-stock-badge">Hết hàng</span>
                            </div>
                            @endif
                        </div>
                        <div class="product-info">
                            <p class="product-category">{{ $product->category->name ?? '' }}</p>
                            <a href="/san-pham/{{ $product->id }}" class="product-name">{{ $product->name }}</a>
                            <div class="product-stars">
                                @for($i = 1; $i <= 5; $i++) <svg
                                    class="{{ $i <= round($product->ratings) ? 'star-filled' : 'star-empty' }}"
                                    fill="currentColor" viewBox="0 0 20 20" style="width:16px;height:16px">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    @endfor
                                    <span class="product-rating-text">({{ $product->ratings }})</span>
                            </div>
                            <div class="product-bottom">
                                <p class="product-price">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                <button class="add-cart-btn" onclick="addToCart({{ $product->id }})"
                                    {{ !$product->in_stock ? 'disabled' : '' }}>
                                    Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- PHÂN TRANG --}}
                <div class="pagination">
                    {{ $products->appends(request()->all())->links('components.pagination') }}
                </div>

                @else
                <div class="empty-products">
                    <img src="/assets/images/orderEmpty.png" alt="Không có sản phẩm" style="width:200px;" />
                    <p>Không tìm thấy sản phẩm nào!</p>
                    <a href="/san-pham" class="btn btn-emerald">Xem tất cả sản phẩm</a>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

@endsection