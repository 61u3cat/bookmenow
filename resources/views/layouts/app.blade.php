<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BookMeNow') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .hero-bg { background: linear-gradient(90deg, #fdf6f0 60%, #fff2f2 100%); }
        </style>
    </head>
    <body class="bg-[#FDFDFC] text-[#1b1b18] min-h-screen flex flex-col font-sans antialiased">
        <!-- Header -->
        <header class="w-full px-6 py-4 flex justify-between items-center bg-white shadow">
            <div class="flex items-center gap-2">
                <svg width="40" height="40" fill="none" viewBox="0 0 40 40"><circle cx="20" cy="20" r="20" fill="#F53003"/><text x="50%" y="55%" text-anchor="middle" fill="#fff" font-size="18" font-family="sans-serif" dy=".3em">BMN</text></svg>
                <span class="font-bold text-lg">BookMeNow</span>
            </div>
            <nav class="flex gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-[#F53003] font-medium hover:underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-[#F53003] font-medium hover:underline">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-[#F53003] font-medium hover:underline">Register</a>
                    @endif
                @endauth
            </nav>
        </header>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-1 px-4 py-8 hero-bg">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="mt-auto bg-[#1b1b18] text-white py-8 px-6 text-center">
            <div class="mb-2 font-semibold">BookMeNow &copy; {{ date('Y') }}</div>
            <div class="text-sm">
                <a href="mailto:support@bookmenow.com" class="underline hover:text-[#F53003]">Contact Support</a>
                <span class="mx-2">|</span>
                <a href="#" class="underline hover:text-[#F53003]">Privacy Policy</a>
            </div>
        </footer>
    </body>
</html>
