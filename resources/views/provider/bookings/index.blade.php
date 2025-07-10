@extends('layouts.app')

@section('content')
    <div class="py-12 hero-bg min-h-[60vh]">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                @if ($bookings->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-[#f3f3f3]">
                            <thead>
                                <tr class="bg-[#fdf6f0] text-[#1b1b18]">
                                    <th class="px-4 py-2 text-left font-semibold">Service</th>
                                    <th class="px-4 py-2 text-left font-semibold">Customer</th>
                                    <th class="px-4 py-2 text-left font-semibold">Phone</th>
                                    <th class="px-4 py-2 text-left font-semibold">Date</th>
                                    <th class="px-4 py-2 text-left font-semibold">Notes</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#f3f3f3]">
                                @foreach ($bookings as $booking)
                                    <tr class="hover:bg-[#fff2f2] transition">
                                        <td class="px-4 py-2">{{ $booking->service->title }}</td>
                                        <td class="px-4 py-2">{{ $booking->customer_name }}</td>
                                        <td class="px-4 py-2">{{ $booking->phone }}</td>
                                        <td class="px-4 py-2">{{ $booking->booking_date }}</td>
                                        <td class="px-4 py-2">{{ $booking->notes ?? '—' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $bookings->links() }}
                    </div>
                @else
                    <div class="text-center text-[#706f6c] py-12">
                        <svg class="mx-auto mb-4" width="48" height="48" fill="none" viewBox="0 0 48 48"><circle cx="24" cy="24" r="24" fill="#F53003" fill-opacity="0.08"/><path d="M16 24h16M24 16v16" stroke="#F53003" stroke-width="2" stroke-linecap="round"/></svg>
                        <p class="text-lg">No bookings yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection