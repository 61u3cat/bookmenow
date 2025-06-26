@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded shadow p-6 mt-8">
    <h2 class="text-2xl font-bold mb-6">Create Service</h2>

    <form action="{{ route('provider.services.store') }}" method="POST" class="space-y-4">
        @csrf
        @include('provider.services.form')
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 mt-4 rounded transition-colors">
            Save
        </button>
    </form>
</div>
@endsection
