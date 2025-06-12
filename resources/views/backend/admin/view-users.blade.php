<x-layouts.app title="All Users">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div
            class="relative h-full flex-1 py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Users</h2>
            @session('error')
                <p class="my-4 text-red-500">{{ session('error') }}</p>
            @endsession
            @session('success')
                <p class="my-4 text-green-500">{{ session('success') }}</p>
            @endsession
            <div class="overflow-y-auto mb-3">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="font-semibold ">
                            <th scope="col" class="p-3">First Name</th>
                            <th scope="col" class="p-3">Last Name</th>
                            <th scope="col" class="p-3">Email</th>
                            <th scope="col" class="p-3">Role</th>
                            <th scope="col" class="p-3">Status</th>
                            <th scope="col" class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <td class="p-3 flex items-center gap-2">
                                    @if ($user->photo)
                                        <img src="{{ $user->photo ? asset($user->photo) : '' }}"
                                            alt="" class="w-8 h-8 rounded-full">
                                    @endif
                                    {{ $user->first_name }}
                                </td>
                                <td class="p-3">{{ $user->last_name }}</td>
                                <td class="p-3">{{ $user->email }}</td>
                                <td class="p-3">{{ $user->role }}</td>
                                <td class="p-3">{{ $user->status == '1' ? 'Active' : 'Inactive' }}</td>
                                <td class="p-3">
                                    {{-- @dd($user->status) --}}
                                    @if ($user->status == '1')
                                        <form action="{{ route('manager.users.deactivate', $user) }}" method="post"
                                            class="mb-1">
                                            @csrf
                                            <flux:button type="submit" variant="danger" size="xs">
                                                Deactivate
                                            </flux:button>
                                        </form>
                                    @else
                                        <form action="{{ route('manager.users.activate', $user) }}" method="post"
                                            class="mb-1">
                                            @csrf
                                            <flux:button type="submit" variant="primary" size="xs">
                                                Activate
                                            </flux:button>
                                        </form>
                                    @endif
                                    <flux:button icon="pencil" wire:navigate
                                        href="{{ route('manager.users.role', $user) }}" variant="primary"
                                        size="xs">
                                        Role
                                    </flux:button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $users->links() }}
        </div>
    </div>
</x-layouts.app>
