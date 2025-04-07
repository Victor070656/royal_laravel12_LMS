<x-layouts.app title="All Users">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div
            class="relative h-full flex-1 py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Users</h2>
            <div class="overflow-y-auto mb-3">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="font-semibold ">
                            <th scope="col" class="p-3">First Name</th>
                            <th scope="col" class="p-3">Last Name</th>
                            <th scope="col" class="p-3">Email</th>
                            <th scope="col" class="p-3">Role</th>
                            <th scope="col" class="p-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <td class="p-3 flex items-center gap-2">
                                    @if ($user->photo)
                                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : '' }}"
                                            alt="" class="w-8 h-8 rounded-full">
                                    @endif
                                    {{ $user->first_name }}
                                </td>
                                <td class="p-3">{{ $user->last_name }}</td>
                                <td class="p-3">{{ $user->email }}</td>
                                <td class="p-3">{{ $user->role }}</td>
                                <td class="p-3">{{ $user->status ? 'Active' : 'Inactive' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $users->links() }}
        </div>
    </div>
</x-layouts.app>
