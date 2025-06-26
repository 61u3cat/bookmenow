@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="rounded-2xl border border-gray-200 bg-gray dark:border-gray-800 dark:bg-white/[0.03] shadow">
        <div class="px-5 py-4 sm:px-6 sm:py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white/90 mb-4 sm:mb-0">Your Services</h2>
            <a href="{{ route('provider.services.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition-colors">
                + New Service
            </a>
        </div>
        <div class="border-t border-gray-100 dark:border-gray-800 p-5 sm:p-6 overflow-x-auto">
            <table class="w-full divide-y divide-gray-200 dark:divide-gray-800">
                <thead>
                    <tr>
                        <th class="bg-yellow-200 dark:bg-yellow-700 px-6 py-4 text-left text-sm font-semibold rounded-tl-2xl">Title</th>
                        <th class="bg-yellow-200 dark:bg-yellow-700 px-6 py-4 text-left text-sm font-semibold">Price</th>
                        <th class="bg-yellow-200 dark:bg-yellow-700 px-6 py-4 text-left text-sm font-semibold">Duration</th>
                        <th class="bg-yellow-200 dark:bg-yellow-700 px-6 py-4 text-left text-sm font-semibold rounded-tr-2xl">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray dark:bg-transparent">
                @forelse ($services as $service)
                    <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                        <td class="px-6 py-4 align-middle text-gray-900 dark:text-gray-100">{{ $service->title }}</td>
                        <td class="px-6 py-4 align-middle text-gray-900 dark:text-gray-100">${{ number_format($service->price, 2) }}</td>
                        <td class="px-6 py-4 align-middle text-gray-900 dark:text-gray-100">{{ $service->duration_minutes }} min</td>
                        <td class="px-6 py-4 align-middle">
                            <a href="{{ route('provider.services.edit', $service) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('provider.services.destroy', $service) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this service?')" class="text-red-600 hover:underline ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400">No services found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
