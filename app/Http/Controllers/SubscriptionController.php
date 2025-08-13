<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function create()
    {
        return view('subscriptions.create', [
            'intent' => Auth::user()->tenant->createSetupIntent(),
            'stripeKey' => config('cashier.key'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $tenant = Auth::user()->tenant;

        try {
            $tenant->newSubscription('default', $request->plan)
                   ->create($request->payment_method);

            return redirect()->route('dashboard')->with('success', 'Subscription successful!');
        } catch (\Exception $e) {
            return back()->withErrors(['stripe_error' => $e->getMessage()]);
        }
    }
}
