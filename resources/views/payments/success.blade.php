@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    
                    <h2 class="text-2xl font-bold mb-4">Payment Successful!</h2>
                    
                    <p class="mb-6">Your booking has been confirmed and payment has been processed successfully.</p>
                    
                    <div class="bg-gray-50 p-4 rounded-lg mb-6 max-w-md mx-auto text-left">
                        <h3 class="text-lg font-semibold mb-2">Booking Details</h3>
                        <p><strong>Service:</strong> {{ $booking->service->title }}</p>
                        <p><strong>Date:</strong> {{ $booking->booking_date }}</p>
                        <p><strong>Amount Paid:</strong> ${{ number_format($paymentIntent->amount / 100, 2) }}</p>
                        <p><strong>Payment ID:</strong> {{ $paymentIntent->id }}</p>
                    </div>
                    
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('customer.my-bookings') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                            View My Bookings
                        </a>
                        <a href="{{ route('services.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">
                            Book Another Service
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection