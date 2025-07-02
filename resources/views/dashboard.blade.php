<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1b1b18] leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 hero-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-[#1b1b18]">
                    {{ __("You're logged in!") }}

                    @if(Auth::user()->role === 'admin')
                        <div class="mt-4 flex flex-wrap gap-4">
                            <a href="{{ route('admin.users.index') }}" class="px-5 py-2 bg-[#F53003] text-white rounded shadow font-medium hover:bg-[#d42a00] transition">Manage Users</a>
                            <a href="{{ route('admin.services.index') }}" class="px-5 py-2 bg-[#F53003] text-white rounded shadow font-medium hover:bg-[#d42a00] transition">Manage Services</a>
                            <a href="{{ route('admin.bookings.index') }}" class="px-5 py-2 bg-[#F53003] text-white rounded shadow font-medium hover:bg-[#d42a00] transition">Manage Bookings</a>
                        </div>
                    @elseif(Auth::user()->role === 'provider')
                        <div class="mt-4 flex flex-wrap gap-4">
                            <a href="{{ route('provider.services.index') }}" class="px-5 py-2 bg-[#F53003] text-white rounded shadow font-medium hover:bg-[#d42a00] transition">My Services</a>
                            <a href="{{ route('provider.bookings.index') }}" class="px-5 py-2 bg-[#F53003] text-white rounded shadow font-medium hover:bg-[#d42a00] transition">My Bookings</a>
                        </div>
                    @else
                        <div class="mt-4 flex flex-wrap gap-4">
                            <a href="{{ route('profile.edit') }}" class="px-5 py-2 bg-[#F53003] text-white rounded shadow font-medium hover:bg-[#d42a00] transition">Edit Profile</a>
                            <a href="{{ route('book.index') }}" class="px-5 py-2 bg-[#F53003] text-white rounded shadow font-medium hover:bg-[#d42a00] transition">Book a Service</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
