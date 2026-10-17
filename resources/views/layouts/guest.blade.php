<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        (function () {
            const stored = localStorage.getItem('theme');
            const theme = stored || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-base-200 font-sans antialiased">
    <div class="relative flex min-h-screen flex-col items-center justify-center px-4 py-10">
        <div class="absolute right-4 top-4">
            <x-theme-toggle />
        </div>

        <a href="{{ url('/') }}" class="mb-6 text-2xl font-bold text-primary">
            Todo list
        </a>

        <div class="w-full max-w-md rounded-box bg-base-100 p-6 shadow-lg sm:p-8">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
</body>

</html>
