<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Show list of services (public)
    public function index()
    {
        $services = Service::latest()->paginate(6);
        return view('public.services.index', compact('services'));
    }

    // Show individual service with booking form
    public function show(Service $service)
    {
        return view('public.services.show', compact('service'));
    }

    // Handle booking form submission
    public function store(Request $request, Service $service)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'booking_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string',
        ]);

        $service->bookings()->create($validated);

        return redirect()->back()->with('success', 'Booking placed successfully!');
    }
}
