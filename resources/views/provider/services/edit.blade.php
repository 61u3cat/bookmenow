@extends('layouts.app')

@section('content')
<div class="container bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded p-6">
    <h2 class="text-xl font-bold mb-4">Edit Service</h2>

    <form action="{{ route('provider.services.update', $service) }}" method="POST">
        @csrf
        @method('PUT')
        @include('provider.services.form')
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 mt-4 rounded">Update</button>
    </form>
</div>
@endsection
