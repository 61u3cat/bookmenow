@extends('layouts.app')

@section('content')
    <div class="py-12 hero-bg min-h-[60vh]">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-8 text-[#1b1b18]">Available Services</h1>

            @if ($services->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($services as $service)
                        <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-[#1b1b18] mb-2">{{ $service->title }}</h2>
                                <p class="mb-3 text-[#706f6c]">{{ Str::limit($service->description, 100) }}</p>
                                <p class="font-bold text-[#F53003] text-lg mb-4">৳ {{ $service->price }}</p>
                            </div>
                            @if (in_array($service->role, $bookedServiceIds))
                                <div class="mt-auto px-6 py-2 bg-gray-300 text-gray-700 rounded shadow text-center">
                                    Already Booked
                                </div>
                            @else
                                <a href="{{ route('book.show', $service) }}"
                                    class="mt-auto inline-block px-6 py-2 bg-[#F53003] text-white rounded shadow font-medium hover:bg-[#d42a00] transition">
                                    Book Now
                                </a>
                            @endif

                        </div>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $services->links() }}
                </div>
            @else
                <div class="text-center text-[#706f6c] py-12">
                    <svg class="mx-auto mb-4" width="48" height="48" fill="none" viewBox="0 0 48 48">
                        <circle cx="24" cy="24" r="24" fill="#F53003" fill-opacity="0.08" />
                        <path d="M16 24h16M24 16v16" stroke="#F53003" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <p class="text-lg">No available services to book.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
