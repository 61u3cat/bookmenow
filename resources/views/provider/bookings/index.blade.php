<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">My Service Bookings</h2>
    </x-slot>

    <div class="py-6 px-4">
        @if ($bookings->count())
            <div class="bg-white shadow sm:rounded-lg p-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->service->title }}</td>
                                <td>{{ $booking->customer_name }}</td>
                                <td>{{ $booking->phone }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->notes ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $bookings->links() }}
                </div>
            </div>
        @else
            <p>No bookings yet.</p>
        @endif
    </div>
</x-app-layout>
