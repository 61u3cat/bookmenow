<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">All Bookings</h2>
    </x-slot>

    <div class="py-6 px-4">
        @if ($bookings->count())
            <table class="w-full border border-gray-300">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr class="border-t">
                            <td>{{ $booking->service->title ?? 'Deleted' }}</td>
                            <td>{{ $booking->customer_name }}</td>
                            <td>{{ $booking->phone }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>{{ $booking->notes ?? '-' }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this booking?')" class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">{{ $bookings->links() }}</div>
        @else
            <p>No bookings found.</p>
        @endif
    </div>
</x-app-layout>
