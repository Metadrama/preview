<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="industrial">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>wip - preview</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen overflow-hidden flex flex-col">
    <!-- Top Navbar -->
    @include('components.navbar')

    <!-- Tab Bar -->
    @include('components.tab-bar')

    <!-- Main Content Area -->
    <div class="flex-1 flex overflow-hidden">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Canvas -->
        @include('components.canvas')
    </div>
</body>
</html>
