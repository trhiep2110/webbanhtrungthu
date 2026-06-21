<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="/assets/images/logo.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Main styles -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/style.css') }}">
    <!-- Responsive styles -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/responsive.css') }}">
    <!-- Toast styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
</head>
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

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toast -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

    {{-- Firebase --}}
    <script src="https://www.gstatic.com/firebasejs/10.14.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.14.0/firebase-auth-compat.js"></script>
    <script>
        firebase.initializeApp({
            apiKey: "{{ env('VITE_FIREBASE_API_KEY') }}",
            authDomain: "{{ env('VITE_FIREBASE_AUTH_DOMAIN') }}",
            projectId: "{{ env('VITE_FIREBASE_PROJECT_ID') }}",
        });
    </script>

    <!-- Main js -->
    <script src="{{ asset('assets/clients/js/main.js') }}"></script>
    <script src="{{ asset('assets/clients/js/custom.js') }}"></script>
</body>

</html>