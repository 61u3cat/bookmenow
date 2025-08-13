<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    // List all services of the logged-in provider
    public function index()
    {
        $services = Service::where('user_id', Auth::id())->get();
        return view('provider.services.index', compact('services'));
    }

    // Show the create form
    public function create()
    {
        return view('provider.services.create');
    }

    // Save the new service
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['tenant_id'] = Auth::user()->tenant_id;

        Service::create($validatedData);

        return redirect()->route('provider.services.index')->with('success', 'Service created successfully.');
    }

    // Show the edit form
    public function edit(Service $service)
    {
        // Prevent editing others' services
        if ($service->user_id !== Auth::id()) {
            abort(403);
        }

        return view('provider.services.edit', compact('service'));
    }

    // Update the service
    public function update(Request $request, Service $service)
    {
        if ($service->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        $service->update($request->only('title', 'description', 'price', 'duration_minutes'));

        return redirect()->route('provider.services.index')->with('success', 'Service updated successfully.');
    }

    // Delete the service
    public function destroy(Service $service)
    {
        if ($service->user_id !== Auth::id()) {
            abort(403);
        }

        $service->delete();
        return redirect()->route('provider.services.index')->with('success', 'Service deleted successfully.');
    }
}
