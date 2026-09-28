<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

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
