<x-layouts.app title="Dashboard">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

                <div class="p-6 text-end">
                    <h3 class="text-2xl font-semibold">{{ $userCount }}</h3>
                    <span class="text-sm text-orange-400">Total Users</span>
                </div>
            </div>
            <div class="relative  overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

                <div class="p-6 text-end">
                    <h3 class="text-2xl font-semibold">{{ $courseCount }}</h3>
                    <span class="text-sm text-orange-600">My Courses</span>
                </div>
            </div>
            <div class="relative  overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

                <div class="p-6 text-end">
                    <h3 class="text-2xl font-semibold">{{ $orderCount }}</h3>
                    <span class="text-sm text-red-500">Total Orders</span>
                </div>
            </div>

        </div>
        <div class="relative  overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="py-4 px-3">
                <h3 class="text-xl font-semibold">Recent Courses</h3>
            </div>
            <div class="overflow-y-auto mb-3 px-3">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="font-semibold ">
                            <th scope="col" class="p-3">Thumbnail</th>
                            <th scope="col" class="p-3">Course Name</th>
                            <th scope="col" class="p-3">Instructor</th>
                            <th scope="col" class="p-3">Short Description</th>
                            <th scope="col" class="p-3">Scheme</th>
                            <th scope="col" class="p-3">Requirements</th>
                            <th scope="col" class="p-3">Price</th>
                            <th scope="col" class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            {{-- @dd($course->user) --}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <td class="p-3">
                                    <img src="{{ $course->thumbnail ? asset($course->thumbnail) : '' }}" alt=""
                                        class="relative aspect-video object-cover h-10 rounded-md">

                                </td>
                                <td class="p-3">
                                    {{ $course->course_name }}
                                </td>
                                <td class="p-3">{{ $course->user->first_name . ' ' . $course->user->last_name }}</td>
                                <td class="p-3 truncated">{{ $course->short_desc }}</td>
                                <td class="p-3">{{ $course->scheme }}</td>
                                <td class="p-3">{{ $course->requirements }}</td>
                                <td class="p-3">{{ $course->price }}</td>
                                <td class="p-3">
                                    <flux:button variant="primary" size="xs" icon="eye" title="View"
                                        wire:navigate href="{{ route('instructor.course.view', $course) }}">
                                    </flux:button>
                                    <flux:button variant="primary" size="xs" icon="pencil" title="Edit"
                                        wire:navigate href="{{ route('instructor.course.edit', $course) }}">
                                    </flux:button>
                                    <flux:button variant="danger" size="xs" icon="trash" title="Delete"
                                        wire:navigate href="{{ route('instructor.course.delete', $course) }}">
                                    </flux:button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
