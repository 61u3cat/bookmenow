<!-- Navigation Bar Component -->
<nav class="bg-gray-100 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            {{-- <a href="{{ route('dashboard') }}">
                <svg width="40" height="40" fill="none" viewBox="0 0 40 40"><circle cx="20" cy="20" r="20" fill="#F53003"/><text x="50%" y="55%" text-anchor="middle" fill="#fff" font-size="18" font-family="sans-serif" dy=".3em">BMN</text></svg>
            </a> --}}
            {{-- <span class="font-bold text-lg text-[#1b1b18]">BookMeNow</span> --}}
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden sm:flex gap-4 items-center">
            @auth
                @php $role = Auth::user()->role ?? null; @endphp
                @if($role === 'admin')
                    <a href="{{ route('admin.users.index') }}" class="text-[#F53003] font-medium hover:underline">Users</a>
                    <a href="{{ route('admin.services.index') }}" class="text-[#F53003] font-medium hover:underline">Services</a>
                    <a href="{{ route('admin.bookings.index') }}" class="text-[#F53003] font-medium hover:underline">Bookings</a>
                @elseif($role === 'provider')
                    <a href="{{ route('provider.services.index') }}" class="text-[#F53003] font-medium hover:underline">My Services</a>
                    <a href="{{ route('provider.bookings.index') }}" class="text-[#F53003] font-medium hover:underline">Booked Services</a>
                @elseif($role === 'customer')
                    <a href="{{ route('customer.my-bookings') }}" class="text-[#F53003] font-medium hover:underline">My Bookings</a>
                    <a href="{{ route('book.index') }}" class="text-[#F53003] font-medium hover:underline">Book Service</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="ml-4 text-[#1b1b18] font-medium hover:underline bg-gray-100 px-3 py-1 rounded">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-[#F53003] font-medium hover:underline">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-[#F53003] font-medium hover:underline">Register</a>
                @endif
            @endauth
        </div>

        <!-- Mobile Hamburger -->
        <div class="sm:hidden flex items-center">
            <button id="mobile-nav-toggle" class="p-2 rounded text-[#1b1b18] hover:bg-gray-200 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-nav-menu" class="hidden sm:hidden bg-gray-100 px-4 pb-4">
        @auth
            @php $role = Auth::user()->role ?? null; @endphp
            @if($role === 'admin')
                <a href="{{ route('admin.users.index') }}" class="block py-2 text-[#F53003] font-medium hover:underline">Users</a>
                <a href="{{ route('admin.services.index') }}" class="block py-2 text-[#F53003] font-medium hover:underline">Services</a>
                <a href="{{ route('admin.bookings.index') }}" class="block py-2 text-[#F53003] font-medium hover:underline">Bookings</a>
            @elseif($role === 'provider')
                <a href="{{ route('provider.services.index') }}" class="block py-2 text-[#F53003] font-medium hover:underline">My Services</a>
                <a href="{{ route('provider.bookings.index') }}" class="block py-2 text-[#F53003] font-medium hover:underline">My Bookings</a>
            @else
                <a href="{{ route('profile.edit') }}" class="block py-2 text-[#F53003] font-medium hover:underline">Profile</a>
                <a href="{{ route('book.index') }}" class="block py-2 text-[#F53003] font-medium hover:underline">Book Service</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full text-left py-2 text-[#1b1b18] font-medium hover:underline bg-gray-100 px-3 rounded">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block py-2 text-[#F53003] font-medium hover:underline">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="block py-2 text-[#F53003] font-medium hover:underline">Register</a>
            @endif
        @endauth
    </div>

    <script>
        // Simple JS for toggling mobile nav
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('mobile-nav-toggle');
            const menu = document.getElementById('mobile-nav-menu');
            if(toggle && menu) {
                toggle.addEventListener('click', function () {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
</nav>
