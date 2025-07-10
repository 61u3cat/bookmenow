@extends('layouts.app')

@section('content')
    <div class="py-6 px-4">
        <h2 class="text-xl font-semibold mb-6">Manage Services</h2>
        @if ($services->count())
            <table class="w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="text-left px-2 py-1">Title</th>
                        <th>Provider</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr class="border-t">
                            <td>{{ $service->title }}</td>
                            <td>{{ $service->provider?->name ?? 'Unknown' }}</td>
                            <td>{{ $service->price }} ৳</td>
                            <td>{{ $service->duration_minutes }} min</td>
                            <td>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this service?')" class="text-red-500 hover:text-[#F53003]">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">{{ $services->links() }}</div>
        @else
            <p>No services found.</p>
        @endif
    </div>
@endsection
