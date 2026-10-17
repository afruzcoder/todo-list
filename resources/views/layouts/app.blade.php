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

    <title>@hasSection('title')@yield('title')@else{{ config('app.name', 'Laravel') }}@endif</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-base-200 font-sans antialiased">
    <div class="navbar bg-base-100 sticky top-0 z-30 shadow-sm">
        <div class="flex-1">
            <a href="{{ url('/') }}" class="btn btn-ghost text-xl normal-case">Todo list</a>
        </div>

        <div class="flex-none gap-2">
            <x-theme-toggle />

            @auth
                <ul class="menu menu-horizontal hidden gap-1 px-1 sm:flex">
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
                    <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                </ul>

                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="placeholder btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full bg-primary text-primary-content">
                            <span>{{ strtoupper(mb_substr(auth()->user()->name ?? 'U', 0, 1)) }}</span>
                        </div>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content z-40 mt-3 w-52 rounded-box bg-base-100 p-2 shadow">
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
                        <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-left">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            @endauth
        </div>
    </div>

    @hasSection('header')
        <div class="border-b border-base-300 bg-base-100">
            <div class="mx-auto max-w-7xl px-4 py-6">
                @yield('header')
            </div>
        </div>
    @elseif (isset($header))
        <div class="border-b border-base-300 bg-base-100">
            <div class="mx-auto max-w-7xl px-4 py-6">
                {{ $header }}
            </div>
        </div>
    @endif

    <main class="mx-auto max-w-7xl px-4 py-8">
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot ?? '' }}
        @endif
    </main>

    @livewireScripts
</body>

</html>
