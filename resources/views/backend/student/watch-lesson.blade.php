<x-layouts.app title="Lesson">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div
            class="relative h-full flex-1 py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Lesson #{{ $lesson->id }}</h2>

            <div class="mb-3">
                @if ($lesson->type == 'video')
                    <div class="relative w-full aspect-video object-fit-cover rounded-xl">
                        <iframe src="{{ $lesson->link }}" frameborder="0" class="w-full h-full rounded-xl"></iframe>
                        {{-- <video class="w-full h-full object-fit-cover rounded-xl" controls>
                            <source src="https://drive.google.com/file/d/1jxXNUMqfzLT7A64gJtPXLpYVQmiLSyOA/preview" />
                        </video> --}}
                        <div class="absolute bg-transparent w-48 h-48 top-0 right-0"></div>
                    </div>
                @else
                    <img class="w-full aspect-video object-fit-cover rounded-xl"
                        src="{{ asset('storage/' . $course->thumbnail) }}" />
                    <a href="{{ $lesson->link }}" class="text-semibold text-blue-500 mt-4 text-decoration-underline"
                        target="_blank">View Material</a>
                @endif
                <div class="py-5">

                    <h2 class="my-4 text-xl font-bold">{{ $lesson->title }}</h2>





                    {{-- course sections --}}
                    <div class="mt-5">
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-xl font-semibold text-blue-600 ">Course Modules</h2>

                        </div>
                        <div id="accordion-open" data-accordion="open">


                            @forelse ($course->sections as $section)
                                <div class="">

                                    <h2 id="accordion-open-heading-{{ $section->id }}">
                                        <button type="button"
                                            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                            data-accordion-target="#accordion-open-body-{{ $section->id }}"
                                            aria-expanded="false"
                                            aria-controls="accordion-open-body-{{ $section->id }}">
                                            <span class="flex items-center"><svg class="w-5 h-5 me-2 shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                                        clip-rule="evenodd"></path>
                                                </svg> {{ $section->section_name }}</span>
                                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                            </svg>
                                        </button>
                                    </h2>
                                    <div id="accordion-open-body-{{ $section->id }}" class="hidden"
                                        aria-labelledby="accordion-open-heading-{{ $section->id }}">
                                        <div
                                            class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">

                                            <div class="">
                                                @forelse ($section->courseContent as $content)
                                                    <div class="p-4 flex items-center border-b justify-between">
                                                        <div class="flex items-center gap-2">
                                                            @if ($content->type == 'video')
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                                    viewBox="0 -960 960 960" width="24px"
                                                                    fill="#e3e3e3">
                                                                    <path
                                                                        d="m380-300 280-180-280-180v360ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                                                </svg>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                                    viewBox="0 -960 960 960" width="24px"
                                                                    fill="#e3e3e3">
                                                                    <path
                                                                        d="M320-440h320v-80H320v80Zm0 120h320v-80H320v80Zm0 120h200v-80H320v80ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z" />
                                                                </svg>
                                                            @endif
                                                            <p class="">{{ $content->title }}</p>
                                                        </div>
                                                        <div class="flex gap-4">

                                                            <flux:button
                                                                href="{{ route('student.lesson.watch', $content) }}"
                                                                wire:navigate variant="primary" size="xs">
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                                    viewBox="0 -960 960 960" width="24px"
                                                                    fill="#333">
                                                                    <path
                                                                        d="m380-300 280-180-280-180v360ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                                                </svg>
                                                            </flux:button>

                                                        </div>
                                                    </div>
                                                @empty
                                                    <p class="p-4">No course content added!</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">No Course Modules Yet</p>
                            @endforelse


                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
