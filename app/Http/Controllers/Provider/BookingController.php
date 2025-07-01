<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $providerId = Auth::id();

        // Show bookings where the service belongs to this provider
        $bookings = Booking::whereHas('service', function ($query) use ($providerId) {
            $query->where('user_id', $providerId);
        })->latest()->paginate(10);

        return view('provider.bookings.index', compact('bookings'));
    }
}
