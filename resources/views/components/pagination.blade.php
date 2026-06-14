@if ($paginator->hasPages())
<div style="display:flex; gap:8px; justify-content:center; flex-wrap:wrap;">
    {{-- Trang trước --}}
    @if ($paginator->onFirstPage())
    <span class="page-btn disabled">«</span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" class="page-btn">«</a>
    @endif

    {{-- Số trang --}}
    @foreach ($elements as $element)
    @if (is_string($element))
    <span class="page-btn disabled">{{ $element }}</span>
    @endif
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <span class="page-btn active">{{ $page }}</span>
    @else
    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Trang sau --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" class="page-btn">»</a>
    @else
    <span class="page-btn disabled">»</span>
    @endif
</div>
@endif