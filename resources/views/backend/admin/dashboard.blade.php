<x-layouts.app title="Dashboard">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

                <div class="p-6 text-end">
                    <h3 class="text-2xl font-semibold">{{ $userCount }}</h3>
                    <span class="text-sm text-orange-400">Total Users</span>
                </div>
            </div>
            <div class="relative  overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

                <div class="p-6 text-end">
                    <h3 class="text-2xl font-semibold">{{ $courseCount }}</h3>
                    <span class="text-sm text-orange-600">Total Courses</span>
                </div>
            </div>
            <div class="relative  overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

                <div class="p-6 text-end">
                    <h3 class="text-2xl font-semibold">{{ $orderCount }}</h3>
                    <span class="text-sm text-red-500">Total Orders</span>
                </div>
            </div>
            <div class="relative  overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

                <div class="p-6 text-end">
                    <h3 class="text-2xl font-semibold">₦{{ number_format($orderAmount) }}</h3>
                    <span class="text-sm text-red-700">Total Amount</span>
                </div>
            </div>
        </div>
        <div
            class="relative  overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="py-4 px-3">
                <h2 class="text-lg font-medium">Recent Users</h2>
            </div>
            <div class="overflow-y-auto mb-3 px-3">

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
                                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : '' }}"
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
                                        <form action="{{ route('manager.users.deactivate', $user) }}" method="post">
                                            @csrf
                                            <flux:button type="submit" variant="danger" size="xs">
                                                Deactivate
                                            </flux:button>
                                        </form>
                                    @else
                                        <form action="{{ route('manager.users.activate', $user) }}" method="post">
                                            @csrf
                                            <flux:button type="submit" variant="primary" size="xs">
                                                Activate
                                            </flux:button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
