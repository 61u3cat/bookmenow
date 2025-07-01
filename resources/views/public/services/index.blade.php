@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Available Services</h1>

        @if ($services->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($services as $service)
                    <div class="border rounded p-4 shadow">
                        <h2 class="text-xl font-semibold">{{ $service->title }}</h2>
                        <p class="mt-2 text-gray-600">{{ Str::limit($service->description, 100) }}</p>
                        <p class="mt-2 font-bold text-green-600">৳ {{ $service->price }}</p>
                        <a href="{{ route('book.show', $service) }}"
                            class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Book Now</a>
                    </div>
                @endforeach
                {{-- @endforeach
        </div> --}}

                <div class="mt-6">
                    {{ $services->links() }}
                </div>
            @else
                <p>No services found.</p>
        @endif
    </div>
@endsection
