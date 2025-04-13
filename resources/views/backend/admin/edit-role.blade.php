<x-layouts.app title="User Role">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="relative  py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Edit Role</h2>
            @session('error')
                <p class="my-4 text-red-500">{{ session('error') }}</p>
            @endsession
            @session('success')
                <p class="my-4 text-green-500">{{ session('success') }}</p>
            @endsession
            <form action="{{ route('manager.users.role', $user) }}" method="post">
                @csrf
                @method('put')
                <div class=" mb-5">
                    <select name="role" id="role" required
                        class="w-full text-sm mb-4 p-3 bg-neutral-200 text-neutral-600 dark:text-neutral-200 dark:bg-neutral-700  rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-300">
                        <option class="bg-neutral-200 text-neutral-600 dark:text-neutral-200 dark:bg-neutral-700"
                            value="" hidden disabled selected>
                            Choose a Role
                        </option>
                        @php
                            $categories = ['user', 'instructor'];
                        @endphp
                        @foreach ($categories as $category)
                            <option class="bg-neutral-200 text-neutral-600 dark:text-neutral-200 dark:bg-neutral-700"
                                value="{{ $category }}" {{ $user->role == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>

                    <flux:button icon="plus" type="submit">Update Role</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
