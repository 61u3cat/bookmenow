<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookMeNow - Online Scheduling for Everyone</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-bg { background: linear-gradient(90deg, #fdf6f0 60%, #fff2f2 100%); }
        .feature-icon { width: 48px; height: 48px; }
    </style>
</head>
<body class="bg-[#FDFDFC] text-[#1b1b18] min-h-screen flex flex-col">
    <!-- Header -->
    <header class="w-full px-6 py-4 flex justify-between items-center bg-white shadow">
        <div class="flex items-center gap-2">
            <svg width="40" height="40" fill="none" viewBox="0 0 40 40"><circle cx="20" cy="20" r="20" fill="#F53003"/><text x="50%" y="55%" text-anchor="middle" fill="#fff" font-size="18" font-family="sans-serif" dy=".3em">BMN</text></svg>
            <span class="font-bold text-lg">BookMeNow</span>
        </div>
        <nav class="flex gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-[#F53003] font-medium hover:underline">Dashboard</a>
                <span class="ml-2 text-[#706f6c]">Hello, {{ Auth::user()->name }}</span>
            @else
                <a href="{{ route('login') }}" class="text-[#F53003] font-medium hover:underline">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-[#F53003] font-medium hover:underline">Register</a>
                @endif
            @endauth
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-bg flex flex-col lg:flex-row items-center justify-between px-6 lg:px-20 py-12 lg:py-24">
        <div class="max-w-xl">
            <h1 class="text-4xl lg:text-5xl font-bold mb-4">Easy Online Scheduling for Everyone</h1>
            <p class="mb-6 text-lg text-[#706f6c]">BookMeNow helps you manage appointments, services, and clients with ease. Save time, grow your business, and delight your customers.</p>
            @guest
                <a href="{{ route('login', ['redirect' => 'book.index']) }}"
                   onclick="event.preventDefault(); 
                            window.location='{{ route('login') }}?message=Please+login+first+to+use+the+service';"
                   class="inline-block px-10 py-4 bg-[#F53003] text-white rounded-xl shadow-lg font-bold text-2xl tracking-wide transition-all duration-200 hover:bg-[oklch(0.865_0.127_207.078)] hover:text-[#d42a00] hover:scale-105 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    Book a Service
                </a>
            @else
                <a href="{{ route('book.index') }}"
                   class="inline-block px-10 py-4 bg-[#F53003] text-white rounded-xl shadow-lg font-bold text-2xl tracking-wide transition-all duration-200 hover:bg-[oklch(0.865_0.127_207.078)] hover:text-[#d42a00] hover:scale-105 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    Book a Service
                </a>
            @endguest
            <div class="mt-4 flex gap-4 text-sm text-[#706f6c]">
                <span>Free to use</span>
                <span>•</span>
                <span>No credit card required</span>
            </div>
        </div>
        <div class="mt-10 lg:mt-0 lg:ml-16">
            <img src="https://25078520.fs1.hubspotusercontent-eu1.net/hub/25078520/hubfs/first-impressions-2.webp?width=600" alt="Booking illustration" class="rounded-lg shadow-lg w-full max-w-md">
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 px-6 lg:px-20 bg-white">
        <h2 class="text-2xl font-bold mb-8 text-center">Why BookMeNow?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <div class="flex flex-col items-center text-center">
                <img src="https://youcanbook.me/hubfs/Brand%20Icons/google-cal.svg" alt="Calendar" class="feature-icon mb-4">
                <h3 class="font-semibold text-lg mb-2">Smart Scheduling</h3>
                <p class="text-[#706f6c]">Let customers book available slots, get instant confirmations, and automatic reminders.</p>
            </div>
            <div class="flex flex-col items-center text-center">
                <img src="https://youcanbook.me/hubfs/zoom.svg" alt="Zoom" class="feature-icon mb-4">
                <h3 class="font-semibold text-lg mb-2">For Any Business</h3>
                <p class="text-[#706f6c]">Perfect for salons, coaches, consultants, healthcare, and more. Manage all your services in one place.</p>
            </div>
            <div class="flex flex-col items-center text-center">
                <img src="https://youcanbook.me/hubfs/stripe.svg" alt="Stripe" class="feature-icon mb-4">
                <h3 class="font-semibold text-lg mb-2">Easy Management</h3>
                <p class="text-[#706f6c]">Track bookings, manage your team, and keep your calendar organized. All from your dashboard.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 px-6 lg:px-20 bg-[#fff2f2]">
        <h2 class="text-2xl font-bold mb-8 text-center">What Our Users Say</h2>
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center gap-4 mb-2">
                    <img src="https://25078520.fs1.hubspotusercontent-eu1.net/hub/25078520/hubfs/Rob%20Profile%20Pic%20(3).jpg?width=100" alt="User" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <div class="font-semibold">Rob Kosberg</div>
                        <div class="text-xs text-[#706f6c]">Publishing Coach</div>
                    </div>
                </div>
                <p class="text-[#1b1b18]">"BookMeNow has made managing my appointments effortless. My clients love the easy booking process!"</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center gap-4 mb-2">
                    <img src="https://25078520.fs1.hubspotusercontent-eu1.net/hub/25078520/hubfs/MrQ%20(1).jpg?width=100" alt="User" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <div class="font-semibold">Fabio Queiroz</div>
                        <div class="text-xs text-[#706f6c]">English Teacher</div>
                    </div>
                </div>
                <p class="text-[#1b1b18]">"I save hours every week and never miss a booking. Highly recommended for any small business!"</p>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 px-6 lg:px-20 bg-white text-center">
        <h2 class="text-2xl font-bold mb-4">Ready to get started?</h2>
        <p class="mb-6 text-[#706f6c]">Join hundreds of businesses using BookMeNow to simplify their scheduling.</p>
        <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-[#F53003] text-white rounded shadow font-semibold text-lg hover:bg-[#d42a00] transition">Create Your Free Account</a>
        <div class="mt-4 flex gap-4 justify-center text-sm text-[#706f6c]">
            <span>Free forever</span>
            <span>•</span>
            <span>No credit card required</span>
        </div>
    </section>

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
