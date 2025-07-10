<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(9);

        $bookedServiceIds = [];
        if (Auth::check()) {
            $bookedServiceIds = \App\Models\Booking::where('user_id', Auth::id())->pluck('service_id')->toArray();
        }

        return view('public.services.index', compact('services', 'bookedServiceIds'));
    }
}
