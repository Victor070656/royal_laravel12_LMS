<x-layouts.app title="Edit Course">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div
            class="relative h-full flex-1 py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Edit Course</h2>
            @session('error')
                <p class="my-4 text-red-500">{{ session('error') }}</p>
            @endsession
            @session('success')
                <p class="my-4 text-green-500">{{ session('success') }}</p>
            @endsession
            <form method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-5">
                    <flux:input label="Course Name *" name="course_name" required autofocus type="text"
                        placeholder="Enter Course Name" value="{{ $course->course_name }}" class="w-full mb-4" />

                    <label for="category_id" class="text-sm font-semibold mb-3">Category *</label>
                    <select name="category_id" id="category_id" required
                        class="w-full text-sm mb-4 p-3 bg-neutral-200 text-neutral-600 dark:text-neutral-200 dark:bg-neutral-700  rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-300">
                        <option class="bg-neutral-200 text-neutral-600 dark:text-neutral-200 dark:bg-neutral-700"
                            value="" hidden disabled selected>
                            Choose a Category
                        </option>
                        @php
                            $categories = \App\Models\Category::all();
                        @endphp
                        @foreach ($categories as $category)
                            <option class="bg-neutral-200 text-neutral-600 dark:text-neutral-200 dark:bg-neutral-700"
                                value="{{ $category->id }}"
                                {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    <flux:textarea label="Short Description *" required name="short_desc" type="text"
                        placeholder="Enter a Short Description" class="w-full mb-4">{{ $course->short_desc }}
                    </flux:textarea>
                    <flux:textarea label="Long Description" name="long_desc" type="text"
                        placeholder="Enter a Long Description" class="w-full mb-4">{{ $course->long_desc }}
                    </flux:textarea>
                    <flux:input label="Course Scheme (Comma seperated) *" name="scheme" value="{{ $course->scheme }}"
                        required type="text" placeholder="Introduction, setting up, ...." class="w-full mb-4" />
                    <flux:input label="Course Requirements (Comma seperated) *" name="requirements"
                        value="{{ $course->requirements }}" required type="text" placeholder="Laptop, Internet, ...."
                        class="w-full mb-4" />
                    <flux:input label="Duration *" name="duration" value="{{ $course->duration }}" required
                        type="text" placeholder="2h 45m" class="w-full mb-4" />
                    <flux:input label="Thumbnail" name="thumbnail" type="file" accept="image/*"
                        placeholder="Choose Thumbnail" class="w-full mb-4" />
                    <img src="{{ asset($course->thumbnail) }}" alt=""
                        class="aspect-video object-cover h-14 rounded-lg mb-3">
                    <flux:input label="Price (₦) *" name="price" value="{{ $course->price }}" required type="number"
                        placeholder="5000" class="w-full mb-4" />
                    <flux:button icon="pencil" type="submit">Edit Course</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
