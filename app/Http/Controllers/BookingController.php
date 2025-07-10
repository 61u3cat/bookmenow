<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show all services with booked info for the current user
    public function index()
    {
        $services = Service::latest()->paginate(9);

        $bookedServiceIds = [];
        if (Auth::check()) {
            $bookedServiceIds = Booking::where('user_id', Auth::id())->pluck('service_id')->toArray();
        }

        return view('public.services.index', compact('services', 'bookedServiceIds'));
    }

    // Show a single service for booking
    public function show(Service $service)
    {
        return view('public.services.show', compact('service'));
    }

    // Store a new booking (POST)
    public function store(Request $request, Service $service)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'booking_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        // Prevent duplicate booking for the same service by the same user
        $alreadyBooked = $service->bookings()
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadyBooked) {
            return redirect()->route('customer.my-bookings')
                ->with('error', 'You have already booked this service.');
        }

        $service->bookings()->create($validated);

        return redirect()->route('customer.my-bookings')->with('success', 'Booking placed successfully!');
    }

    // Show bookings for the logged-in customer
    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('service')
            ->latest()
            ->paginate(10);

        return view('customer.my-bookings', compact('bookings'));
    }
}
