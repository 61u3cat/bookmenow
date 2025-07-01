<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Admin Dashboard</h2>
    </x-slot>

    <div class="py-6 px-4 space-y-4">
        <a href="{{ route('admin.users.index') }}" class="text-white-600 underline">Manage Users</a>
        <a href="{{ route('admin.services.index') }}" class="text-blue-600 underline">Manage Services</a>
        <a href="{{ route('admin.bookings.index') }}" class="text-blue-600 underline">Manage Bookings</a>
    </div>
</x-app-layout>
