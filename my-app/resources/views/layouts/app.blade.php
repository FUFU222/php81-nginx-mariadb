<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />
</head>

<body>
    <header>
        <a href="{{ route('posts.index') }}">
            <h1 class="text-brand">Instagram Clone</h1>
        </a>
    </header>
    <div class="content">
        @yield('content')
    </div>
    <footer>
        <p>Copyright 2026 Instagram Clone</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    @if (session('toast'))
        @php
            $toast = session('toast');
            $toastColors = [
                'created' => '#22c55e',
                'updated' => '#3b82f6',
                'deleted' => '#ef4444',
                'error' => '#ef4444',
            ];
            $toastColor = $toastColors[$toast['type']] ?? '#3b82f6';
        @endphp
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Toastify({
                    text: @json($toast['message']),
                    duration: 3000,
                    gravity: 'top',
                    position: 'right',
                    close: true,
                    stopOnFocus: true,
                    style: {
                        borderRadius: '9999px',
                        padding: '12px 24px',
                        background: @json($toastColor),
                    },
                }).showToast();
            });
        </script>
    @endif
</body>

</html>
