@extends('layouts.admin')

@section('content')

<div class="admin-table-header">
    <h2 class="admin-page-title">Danh Sách Sản Phẩm</h2>
    <div style="display:flex;gap:12px;align-items:center;">
        <div class="admin-search">
            <input type="text" id="search-input" placeholder="Tìm kiếm sản phẩm..." onkeyup="searchProducts()" />
        </div>
        <button class="btn btn-emerald" onclick="openAddModal()">+ Thêm sản phẩm</button>
    </div>
</div>

{{-- FILTER --}}
<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap;">
    <select class="form-input" style="width:auto;"
        onchange="window.location.href='/admin/san-pham?category='+this.value">
        <option value="">Tất cả danh mục</option>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>
    <select class="form-input" style="width:auto;"
        onchange="window.location.href='/admin/san-pham?manufacturer='+this.value">
        <option value="">Tất cả thương hiệu</option>
        @foreach($manufacturers as $m)
        <option value="{{ $m->id }}" {{ request('manufacturer') == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
        @endforeach
    </select>
</div>

{{-- TABLE --}}
<div class="admin-table-wrap">
    <table class="admin-table" id="products-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Giá</th>
                <th>Tồn kho</th>
                <th>Đánh giá</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            @php
            $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
            $firstImg = $images[0] ?? '/assets/images/default.avif';
            @endphp
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    <img src="{{ $firstImg }}" alt="{{ $product->name }}"
                        style="width:56px;height:56px;border-radius:8px;object-fit:cover;" />
                </td>
                <td>
                    <p style="font-weight:600;max-width:200px;line-height:1.4;">{{ $product->name }}</p>
                    <p style="font-size:12px;color:var(--gray);">{{ $product->code }}</p>
                </td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td>{{ $product->manufacturer->name ?? '-' }}</td>
                <td><strong style="color:var(--emerald);">{{ number_format($product->price, 0, ',', '.') }}đ</strong>
                </td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <div style="display:flex;align-items:center;gap:4px;">
                        <svg style="width:14px;height:14px;color:#f59e0b;" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        {{ $product->ratings }}
                    </div>
                </td>
                <td>
                    @if($product->in_stock)
                    <span class="badge badge-success">Còn hàng</span>
                    @else
                    <span class="badge badge-danger">Hết hàng</span>
                    @endif
                </td>
                <td>
                    <div class="admin-actions">
                        <button class="btn-action btn-view" onclick="viewProduct({{ $product->id }})" title="Xem">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        <button class="btn-action btn-edit" onclick="editProduct({{ $product->id }})" title="Sửa">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <button class="btn-action btn-delete" onclick="deleteProduct({{ $product->id }})" title="Xóa">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- PHÂN TRANG --}}
<div class="pagination" style="margin-top:20px;">
    {{ $products->appends(request()->all())->links('components.pagination') }}
</div>

{{-- MODAL THÊM/SỬA SẢN PHẨM --}}
<div id="product-modal" class="admin-modal" style="display:none;">
    <div class="admin-modal-overlay" onclick="closeModal()"></div>
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3 id="modal-title">Thêm sản phẩm</h3>
            <button onclick="closeModal()" class="admin-modal-close">✕</button>
        </div>
        <div class="admin-modal-body">
            <div id="modal-error" class="auth-alert auth-alert-error" style="display:none;"></div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tên sản phẩm (VI)</label>
                    <input type="text" id="p-name" class="form-input" placeholder="Nhập tên sản phẩm" />
                </div>
                <div class="form-group">
                    <label class="form-label">Tên sản phẩm (EN)</label>
                    <input type="text" id="p-name-en" class="form-input" placeholder="Product name in English" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Mã sản phẩm</label>
                    <input type="text" id="p-code" class="form-input" placeholder="VD: KD-001" />
                </div>
                <div class="form-group">
                    <label class="form-label">Danh mục</label>
                    <select id="p-category" class="form-input">
                        <option value="">Chọn danh mục</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Thương hiệu</label>
                    <select id="p-manufacturer" class="form-input">
                        <option value="">Chọn thương hiệu</option>
                        @foreach($manufacturers as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Giá bán (đ)</label>
                    <input type="number" id="p-price" class="form-input" placeholder="VD: 85000" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Giá vốn (đ)</label>
                    <input type="number" id="p-cost" class="form-input" placeholder="VD: 50000" />
                </div>
                <div class="form-group">
                    <label class="form-label">Số lượng</label>
                    <input type="number" id="p-quantity" class="form-input" placeholder="VD: 100" />
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Mô tả sản phẩm</label>
                <textarea id="p-description" class="form-input" rows="4"
                    placeholder="Nhập mô tả sản phẩm..."></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Ảnh sản phẩm (URL, mỗi dòng 1 URL)</label>
                <textarea id="p-images" class="form-input" rows="3"
                    placeholder="https://example.com/image1.jpg&#10;https://example.com/image2.jpg"></textarea>
            </div>
        </div>
        <div class="admin-modal-footer">
            <button onclick="closeModal()" class="btn-outline-emerald">Hủy</button>
            <button onclick="saveProduct()" class="btn btn-emerald" id="save-btn">Lưu sản phẩm</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let editingProductId = null;

    function searchProducts() {
        const keyword = document.getElementById('search-input').value.toLowerCase();
        const rows = document.querySelectorAll('#products-table tbody tr');
        rows.forEach(row => {
            const name = row.cells[2]?.textContent.toLowerCase() || '';
            row.style.display = name.includes(keyword) ? '' : 'none';
        });
    }

    function openAddModal() {
        editingProductId = null;
        document.getElementById('modal-title').textContent = 'Thêm sản phẩm';
        document.getElementById('product-modal').style.display = 'flex';
        clearForm();
    }

    function editProduct(id) {
        editingProductId = id;
        document.getElementById('modal-title').textContent = 'Sửa sản phẩm';
        document.getElementById('product-modal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('product-modal').style.display = 'none';
        editingProductId = null;
    }

    function clearForm() {
        ['p-name', 'p-name-en', 'p-code', 'p-price', 'p-cost', 'p-quantity', 'p-description', 'p-images'].forEach(id => {
            document.getElementById(id).value = '';
        });
        document.getElementById('p-category').value = '';
        document.getElementById('p-manufacturer').value = '';
    }

    async function saveProduct() {
        const errorEl = document.getElementById('modal-error');
        errorEl.style.display = 'none';

        const images = document.getElementById('p-images').value
            .split('\n').map(s => s.trim()).filter(s => s);

        const data = {
            name: document.getElementById('p-name').value,
            name_en: document.getElementById('p-name-en').value,
            code: document.getElementById('p-code').value,
            category_id: document.getElementById('p-category').value,
            manufacturer_id: document.getElementById('p-manufacturer').value,
            price: document.getElementById('p-price').value,
            cost_price: document.getElementById('p-cost').value,
            quantity: document.getElementById('p-quantity').value,
            description: document.getElementById('p-description').value,
            images: images,
        };

        if (!data.name || !data.price) {
            errorEl.textContent = 'Vui lòng điền tên và giá sản phẩm!';
            errorEl.style.display = 'block';
            return;
        }

        const url = editingProductId ? `/api/v1/product/${editingProductId}` : '/api/v1/product';
        const method = editingProductId ? 'PUT' : 'POST';

        const res = await apiFetch(url.replace('/api/v1', ''), {
            method,
            body: JSON.stringify(data)
        });

        if (res?.code === 200 || res?.code === 201) {
            showToast(editingProductId ? 'Cập nhật sản phẩm thành công!' : 'Thêm sản phẩm thành công!');
            closeModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            errorEl.textContent = res?.message || 'Có lỗi xảy ra!';
            errorEl.style.display = 'block';
        }
    }

    async function deleteProduct(id) {
        if (!confirm('Bạn có chắc muốn xóa sản phẩm này?')) return;
        const res = await apiFetch(`/product/${id}`, {
            method: 'DELETE'
        });
        if (res?.code === 200) {
            showToast('Xóa sản phẩm thành công!');
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showToast('Có lỗi xảy ra!', 'error');
        }
    }

    function viewProduct(id) {
        window.open(`/san-pham/${id}`, '_blank');
    }
</script>
@endpush