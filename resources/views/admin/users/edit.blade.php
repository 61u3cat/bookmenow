@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Edit User Role</h2>
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-medium">Name</label>
            <input type="text" value="{{ $user->name }}" class="w-full border rounded px-3 py-2 bg-gray-100" disabled>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" value="{{ $user->email }}" class="w-full border rounded px-3 py-2 bg-gray-100" disabled>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Role</label>
            <select name="role" class="w-full border rounded px-3 py-2" required>
                @foreach($roles as $role)
                    <option value="{{ $role }}" @if($user->role === $role) selected @endif>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-[#F53003] text-white px-6 py-2 rounded hover:bg-[#d42a00]">Update Role</button>
    </form>
</div>
@endsection