<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate common fields
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:provider,customer'],
        ];

        // If registering as provider, require provider fields
        if ($request->role === 'provider') {
            $rules = array_merge($rules, [
                'business_name' => 'required|string|max:255',
                'business_details' => 'required|string',
                'address' => 'required|string|max:255',
                'govt_no' => 'nullable|string|max:255',
                'contact' => 'required|string|max:255',
            ]);
        }

        $validated = $request->validate($rules);

        // Prepare user data
        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ];

        // Add provider fields if role is provider
        if ($validated['role'] === 'provider') {
            $userData['business_name'] = $validated['business_name'];
            $userData['business_details'] = $validated['business_details'];
            $userData['address'] = $validated['address'];
            $userData['govt_no'] = $validated['govt_no'] ?? null;
            $userData['contact'] = $validated['contact'];
        }

        $user = User::create($userData);

        event(new Registered($user));
        Auth::login($user);

        // Redirect based on role
        if ($user->role === 'provider') {
            return redirect()->route('dashboard');
        }
        return redirect('/dashboard');
    }

    // public function showProviderForm()
    // {
    //     return view('auth.register-provider');
    // }

    public function registerProvider(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'business_name' => 'required|string|max:255',
            'business_details' => 'required|string',
            'address' => 'required|string|max:255',
            'govt_no' => 'nullable|string|max:255',
            'contact' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'provider',
            'business_name' => $validated['business_name'],
            'business_details' => $validated['business_details'],
            'address' => $validated['address'],
            'govt_no' => $validated['govt_no'] ?? null,
            'contact' => $validated['contact'],
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
