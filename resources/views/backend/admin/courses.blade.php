<x-layouts.app title="Courses">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div
            class="relative h-full flex-1 py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Courses</h2>
            <div class="overflow-y-auto mb-3">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="font-semibold ">
                            <th scope="col" class="p-3">Course Name</th>
                            <th scope="col" class="p-3">Instructor</th>
                            <th scope="col" class="p-3">Short Description</th>
                            <th scope="col" class="p-3">Scheme</th>
                            <th scope="col" class="p-3">Requirements</th>
                            <th scope="col" class="p-3">Price</th>
                            <th scope="col" class="p-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                        {{-- @dd($course->user) --}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <td class="p-3 flex items-center gap-2">
                                    @if ($course->thumbnail)
                                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : '' }}"
                                            alt="" class="relative aspect-video h-10 rounded-md">
                                    @endif
                                    {{ $course->course_name }}
                                </td>
                                <td class="p-3">{{ $course->user->first_name . " ".$course->user->last_name }}</td>
                                <td class="p-3 truncated">{{ $course->short_desc }}</td>
                                <td class="p-3">{{ $course->scheme }}</td>
                                <td class="p-3">{{ $course->requirements }}</td>
                                <td class="p-3">{{ $course->price }}</td>
                                <td class="p-3">
                                    <flux:button>Edit</flux:button>
                                    <flux:button>Delete</flux:button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $courses->links() }}
        </div>
    </div>
</x-layouts.app>
