<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Manage Users</h2>
    </x-slot>

    <div class="py-6 px-4">
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
                            <td>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete?')" class="text-red-500">Delete</button>
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
</x-app-layout>
