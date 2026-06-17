// ===== CẤU HÌNH API =====
const API_URL = '';

// ===== TOKEN MANAGEMENT =====
const getToken = () => localStorage.getItem('access_token');
const getUser = () => {
    const user = localStorage.getItem('user');
    return user ? JSON.parse(user) : null;
};
const removeToken = () => localStorage.removeItem('access_token');
const removeUser = () => localStorage.removeItem('user');

// ===== FETCH WRAPPER =====
async function apiFetch(endpoint, options = {}) {
    const token = getToken();
    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
        ...options.headers,
    };
    if (token) headers['Authorization'] = `Bearer ${token}`;

    try {
        const res = await fetch(`${API_URL}${endpoint}`, { ...options, headers });
        const data = await res.json();
        if (res.status === 401) {
            removeToken();
            removeUser();
            window.location.href = '/dang-nhap';
            return null;
        }
        return data;
    } catch (err) {
        console.error('API Error:', err);
        return null;
    }
}

// ===== API MODULES =====
const authAPI = {
    login: (email, password) => apiFetch('/auth/login', { method: 'POST', body: JSON.stringify({ email, password }) }),
    register: (data) => apiFetch('/auth/register', { method: 'POST', body: JSON.stringify(data) }),
    logout: () => apiFetch('/auth/logout', { method: 'POST' }),
    me: () => apiFetch('/auth/me'),
};

const productAPI = {
    getAll: (params = {}) => apiFetch(`/product?${new URLSearchParams(params)}`),
    getById: (id) => apiFetch(`/product/${id}`),
};

const categoryAPI = {
    getAll: () => apiFetch('/category'),
};

const cartAPI = {
    get: () => apiFetch('/cart'),
    add: (productId, quantity = 1) => apiFetch('/cart', { method: 'POST', body: JSON.stringify({ product_id: productId, quantity }) }),
    update: (detailId, quantity) => apiFetch(`/cart/${detailId}`, { method: 'PUT', body: JSON.stringify({ quantity }) }),
    remove: (detailId) => apiFetch(`/cart/${detailId}`, { method: 'DELETE' }),
};

// ===== TOAST =====
function showToast(message, type = 'success') {
    let toast = document.getElementById('toast');
    if (!toast) return;
    toast.textContent = message;
    toast.style.background = type === 'error' ? '#ef4444' : '#065f46';
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3000);
}

// ===== FORMAT CURRENCY =====
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN').format(amount) + 'đ';
}

// ===== RENDER STARS =====
function renderStars(rating) {
    let html = '';
    for (let i = 1; i <= 5; i++) {
        html += `<svg class="${i <= Math.round(rating) ? 'star-filled' : 'star-empty'}" 
            fill="currentColor" viewBox="0 0 20 20" style="width:16px;height:16px">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>`;
    }
    return html;
}

// ===== RENDER PRODUCT CARD =====
function renderProductCard(product) {
    const images = Array.isArray(product.images) ? product.images : (JSON.parse(product.images || '[]'));
    const firstImg = images[0] || '/default.avif';
    const inStock = product.in_stock;
    return `
    <div class="product-card">
        <div class="product-img-wrap">
            <a href="/san-pham/${product.id}">
                <img src="${firstImg}" alt="${product.name}" loading="lazy" />
            </a>
            <button class="product-favorite" onclick="toggleFavorite(${product.id}, this)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:20px;height:20px">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </button>
            ${!inStock ? `<div class="out-of-stock-overlay"><span class="out-of-stock-badge">Hết hàng</span></div>` : ''}
        </div>
        <div class="product-info">
            <p class="product-category">${product.category?.name || ''}</p>
            <a href="/san-pham/${product.id}" class="product-name">${product.name}</a>
            <div class="product-stars">
                ${renderStars(product.ratings)}
                <span class="product-rating-text">(${product.ratings})</span>
            </div>
            <div class="product-bottom">
                <p class="product-price">${formatCurrency(product.price)}</p>
                <button class="add-cart-btn" onclick="addToCart(${product.id})" ${!inStock ? 'disabled' : ''}>
                    Thêm vào giỏ
                </button>
            </div>
        </div>
    </div>`;
}

// ===== CART =====
async function addToCart(productId) {
    const user = getUser();
    if (!user) {
        showToast('Vui lòng đăng nhập để thêm vào giỏ hàng!', 'error');
        setTimeout(() => window.location.href = '/dang-nhap', 1500);
        return;
    }
    const res = await cartAPI.add(productId, 1);
    if (res?.code === 200) {
        showToast('Đã thêm vào giỏ hàng!');
        updateCartCount();
    } else {
        showToast(res?.message || 'Có lỗi xảy ra!', 'error');
    }
}

async function updateCartCount() {
    const res = await cartAPI.get();
    const count = res?.data?.cart_details?.length || 0;
    const el = document.getElementById('cart-count');
    if (el) el.textContent = count;
}

async function toggleFavorite(productId, btn) {
    const user = getUser();
    if (!user) { showToast('Vui lòng đăng nhập!', 'error'); return; }
    btn.classList.toggle('active');
    showToast(btn.classList.contains('active') ? 'Đã thêm vào yêu thích!' : 'Đã xóa khỏi yêu thích!');
}

// ===== HEADER =====
function toggleSearch() {
    const bar = document.getElementById('search-bar');
    bar.style.display = bar.style.display === 'block' ? 'none' : 'block';
}

function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

function setLang(lang) {
    document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
    event.target.closest('.lang-btn').classList.add('active');
    localStorage.setItem('lang', lang);
    showToast('Đã chuyển ngôn ngữ!');
}

async function logout() {
    await authAPI.logout();
    removeToken();
    removeUser();
    window.location.href = '/';
}

function updateHeaderUser() {
    const user = getUser();
    const loginBtn = document.getElementById('login-btn');
    const userMenu = document.getElementById('user-menu');
    if (!loginBtn) return;
    if (user) {
        loginBtn.style.display = 'none';
        if (userMenu) {
            userMenu.style.display = 'flex';
            const avatar = document.getElementById('user-avatar');
            if (avatar) avatar.src = user.avatar || '/default.avif';
        }
    }
}

// ===== INIT =====
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    updateHeaderUser();
});