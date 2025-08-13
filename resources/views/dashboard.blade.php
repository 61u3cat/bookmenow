@extends('layouts.app')

@section('content')
    <div class="py-12 hero-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-[#1b1b18]">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-2">Welcome, {{ Auth::user()->name }}!</h3>
                        <p class="text-[#706f6c]">Role: <span class="font-semibold">{{ ucfirst(Auth::user()->role) }}</span></p>
                        <p class="text-[#706f6c] mt-1">Email: <span class="font-semibold">{{ Auth::user()->email }}</span></p>
                        <p class="text-[#706f6c] mt-1">Member since: <span class="font-semibold">{{ Auth::user()->created_at->format('F Y') }}</span></p>
                    </div>

                    @if(Auth::user()->role === 'admin')
                        <div class="mt-4 flex flex-wrap gap-4">
                            <a href="{{ route('admin.users.index') }}" class="px-5 py-2 bg-[#F53003] text-black rounded shadow font-medium hover:bg-[#b91c1c] transition">Manage Users</a>
                            <a href="{{ route('admin.services.index') }}" class="px-5 py-2 bg-[#F53003] text-black rounded shadow font-medium hover:bg-[#b91c1c] transition">Manage Services</a>
                            <a href="{{ route('admin.bookings.index') }}" class="px-5 py-2 bg-[#F53003] text-black rounded shadow font-medium hover:bg-[#b91c1c] transition">Manage Bookings</a>
                        </div>
                        <div class="mt-8">
                            <h4 class="font-semibold mb-2">Quick Stats</h4>
                            <ul class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <li class="bg-[#fdf6f0] rounded p-4 text-center">
                                    <div class="text-2xl font-bold">{{ $userCount ?? '--' }}</div>
                                    <div class="text-[#706f6c]">Total Users</div>
                                </li>
                                <li class="bg-[#fdf6f0] rounded p-4 text-center">
                                    <div class="text-2xl font-bold">{{ $serviceCount ?? '--' }}</div>
                                    <div class="text-[#706f6c]">Total Services</div>
                                </li>
                                <li class="bg-[#fdf6f0] rounded p-4 text-center">
                                    <div class="text-2xl font-bold">{{ $bookingCount ?? '--' }}</div>
                                    <div class="text-[#706f6c]">Total Bookings</div>
                                </li>
                            </ul>
                        </div>
                    @elseif(Auth::user()->role === 'provider')
                        <div class="mt-4 flex flex-wrap gap-4">
                            <a href="{{ route('provider.services.index') }}" class="px-5 py-2 bg-[#F53003] text-black rounded shadow font-medium hover:bg-[#b91c1c] transition">My Services</a>
                            <a href="{{ route('provider.bookings.index') }}" class="px-5 py-2 bg-[#F53003] text-black rounded shadow font-medium hover:bg-[#b91c1c] transition">My Bookings</a>
                        </div>
                        <div class="mt-8">
                            <h4 class="font-semibold mb-2">Your Stats</h4>
                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <li class="bg-[#fdf6f0] rounded p-4 text-center">
                                    <div class="text-2xl font-bold">{{ $myServiceCount ?? '--' }}</div>
                                    <div class="text-[#706f6c]">Your Services</div>
                                </li>
                                <li class="bg-[#fdf6f0] rounded p-4 text-center">
                                    <div class="text-2xl font-bold">{{ $myBookingCount ?? '--' }}</div>
                                    <div class="text-[#706f6c]">Your Bookings</div>
                                </li>
                            </ul>
                        </div>
                    @elseif(Auth::user()->role === 'customer')
                        <div class="mt-4 flex flex-wrap gap-4">
                            <a href="{{ route('profile.edit') }}" class="px-5 py-2 bg-[#F53003] text-black rounded shadow font-medium hover:bg-[#b91c1c] transition">Edit Profile</a>
                            <a href="{{ route('services.index') }}" class="px-5 py-2 bg-[#F53003] text-black rounded shadow font-medium hover:bg-[#b91c1c] transition">Book a Service</a>
                        </div>
                        <div class="mt-8">
                            <h4 class="font-semibold mb-2">Booking Tips</h4>
                            <ul class="list-disc list-inside text-[#706f6c] space-y-1">
                                <li>Browse available services and book instantly.</li>
                                <li>Manage your bookings from your profile.</li>
                                <li>Contact support for any help.</li>
                            </ul>
                        </div>
                    @endif

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="mt-8">
                        @csrf
                        <button type="submit" class="px-5 py-2 bg-[#1b1b18] text-white rounded shadow font-medium hover:bg-[#F53003] transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
