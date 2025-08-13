@extends('layouts.app')

@section('content')
    <div class="py-6 px-4">
        <h2 class="text-xl font-semibold mb-6">My Bookings</h2>
        @if($bookings->count())
            <div class="overflow-hidden rounded-lg border">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Service
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $booking->service->title ?? 'Deleted' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $booking->booking_date }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($booking->status == 'pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">Pending</span>
                                    @elseif($booking->status == 'paid')
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Paid</span>
                                    @else
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>You haven't made any bookings yet.</p>
        @endif

        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    </div>
@endsection