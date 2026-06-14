<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Bánh Trung Thu</title>
    <link rel="icon" type="image/png" href="/assets/images/logo.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>

    {{-- HEADER --}}
    @include('components.header')

    {{-- NỘI DUNG TRANG --}}
    @yield('content')

    {{-- FOOTER --}}
    @include('components.footer')

    {{-- CHAT BUTTON --}}
    <button class="chat-btn" onclick="window.location.href='/lien-he'">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M21 16c0 1.1-.9 2-2 2H7l-4 4V6a2 2 0 012-2h14a2 2 0 012 2v10z" />
        </svg>
    </button>

    {{-- TOAST --}}
    <div id="toast" class="toast"></div>

    @stack('scripts')
</body>

</html>