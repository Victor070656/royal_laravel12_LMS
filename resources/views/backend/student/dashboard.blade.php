<x-layouts.app title="Dashboard">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-6 text-end">
                    <h3 class="text-2xl font-semibold">{{ $allCourseCount }}</h3>
                    <span class="text-sm text-orange-400">Available Courses</span>
                </div>
            </div>
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-6 text-end">
                    <h3 class="text-2xl font-semibold">{{ $courseCount }}</h3>
                    <span class="text-sm text-orange-400">My Courses</span>
                </div>
            </div>
        </div>
        <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            <img src="{{ asset('front/assets/images/banner/learn.png') }}" alt=""
                class="w-full h-full aspect-video opacity-45" style="object-fit: cover !important;">
        </div>
    </div>
</x-layouts.app>
