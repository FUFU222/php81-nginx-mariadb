<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <h1 class="text-brand">Instagram Clone</h1>
    </header>
    <div class="content">
        @yield('content')
    </div>
    <footer>
        <p>Copyright 2026 Instagram Clone</p>
    </footer>
</body>

</html>
