<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') — Wedding Manager</title>

    @vite(['resources/css/app.css', 'resources/js/app.ts'])
</head>
<body>
    <div id="sidebarOverlay" class="sidebar-overlay"></div>

    @include('layouts.sidebar')

    <div class="admin-main">
        @include('layouts.navbar')

        <main class="admin-content">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>