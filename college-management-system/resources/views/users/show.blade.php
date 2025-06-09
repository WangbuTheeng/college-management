<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details: ') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">User Information</h3>
                            <p class="mt-1 text-sm text-gray-600"><strong>Name:</strong> {{ $user->name }}</p>
                            <p class="mt-1 text-sm text-gray-600"><strong>Email:</strong> {{ $user->email }}</p>
                            <p class="mt-1 text-sm text-gray-600"><strong>Gender:</strong> {{ ucfirst($user->gender ?? 'N/A') }}</p>
                            <p class="mt-1 text-sm text-gray-600"><strong>Contact:</strong> {{ $user->contact ?? 'N/A' }}</p>
                            <p class="mt-1 text-sm text-gray-600"><strong>Roles:</strong> {{ $user->roles->pluck('name')->join(', ') }}</p>
                            <p class="mt-1 text-sm text-gray-600"><strong>Member Since:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            @if ($user->profile_image)
                                <h3 class="text-lg font-medium text-gray-900">Profile Image</h3>
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="mt-2 h-40 w-40 object-cover rounded-full">
                            @else
                                <h3 class="text-lg font-medium text-gray-900">No Profile Image</h3>
                            @endif
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Back to Users List</a>
                        @can('edit_users', $user)
                        <a href="{{ route('users.edit', $user->id) }}" class="ml-2 px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">Edit User</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
