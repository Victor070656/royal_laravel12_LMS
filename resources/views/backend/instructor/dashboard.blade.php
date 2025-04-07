<x-layouts.app title="Dashboard">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                {{-- <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
                <div class="p-8 text-end">
                    <h3 class="text-3xl font-semibold">0</h3>
                    <span class="text-sm">Total Courses</span>
                </div>
            </div>
            <div class="relative  overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                {{-- <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
                <div class="p-8 text-end">
                    <h3 class="text-3xl font-semibold">0</h3>
                    <span class="text-sm">Total Purchased</span>
                </div>
            </div>
            <div class="relative  overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                {{-- <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
                <div class="p-8 text-end">
                    <h3 class="text-3xl font-semibold">0</h3>
                    <span class="text-sm">Total Courses</span>
                </div>
            </div>
        </div>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
