@extends('layouts.app')

@section('content')
    <div class="py-6 px-4">
        <h2 class="text-xl font-semibold mb-6">Manage Users</h2>
        @if ($users->count())
            <table class="w-full border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-2 py-1">Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-t">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="flex space-x-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete?')" class="text-red-500 hover:text-[#F53003]">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">{{ $users->links() }}</div>
        @else
            <p>No users found.</p>
        @endif
    </div>
@endsection
