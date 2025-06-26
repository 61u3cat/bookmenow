@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-2xl">
    <h1 class="text-3xl font-bold">{{ $service->title }}</h1>
    <p class="mt-2 text-gray-700">{{ $service->description }}</p>
    <p class="mt-2 font-bold text-green-700">৳ {{ $service->price }}</p>

    <hr class="my-6">

    <h2 class="text-2xl font-semibold mb-4">Book This Service</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 rounded text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('book.store', $service) }}" class="space-y-4">
        @csrf

        <div>
            <label for="customer_name" class="block font-medium">Your Name</label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required class="w-full border rounded px-3 py-2">
            @error('customer_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="phone" class="block font-medium">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="w-full border rounded px-3 py-2">
            @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="booking_date" class="block font-medium">Date</label>
            <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date') }}" required class="w-full border rounded px-3 py-2">
            @error('booking_date') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="notes" class="block font-medium">Additional Notes</label>
            <textarea name="notes" id="notes" class="w-full border rounded px-3 py-2">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Confirm Booking</button>
    </form>
</div>
@endsection
