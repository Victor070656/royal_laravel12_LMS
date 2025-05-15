<x-layouts.app title="My Courses">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">


        <div
            class="px-4 py-5 relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-2xl font-bold">My Courses</h2>
            <div class="mt-4 grid grid-cols-3 gap-4">
                @forelse($orders as $order)
                    <div class=" rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <a href="{{ route('student.course.details', $order) }}">

                            <img src="{{ asset('storage/' . $order->course->thumbnail) }}" alt=""
                                class="w-full aspect-video object-cover rounded-t-xl">
                            <div class="p-4">
                                <h4 class="text-lg font-semibold truncate">{{ $order->course->course_name }}</h4>
                                <p class="font-medium text-sm">By:
                                    {{ $order->course->user->first_name . ' ' . $order->course->user->last_name }}</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-3 text-center">
                        <p>You have to purchase a course to see it here</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>
