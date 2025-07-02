<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">My Bookings</h2>
    </x-slot>

    <div class="py-6 px-4">
        @forelse($bookings as $booking)
            <div class="border p-4 rounded mb-4">
                <h3 class="font-semibold text-lg">{{ $booking->service->title ?? 'Service Deleted' }}</h3>
                <p><strong>Date:</strong> {{ $booking->booking_date }}</p>
                <p><strong>Phone:</strong> {{ $booking->phone }}</p>
                <p><strong>Notes:</strong> {{ $booking->notes ?? 'N/A' }}</p>
                <p><strong>Status:</strong> <span class="text-blue-600">Pending</span></p>
            </div>
        @empty
            <p>You haven't made any bookings yet.</p>
        @endforelse

        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    </div>
</x-app-layout>