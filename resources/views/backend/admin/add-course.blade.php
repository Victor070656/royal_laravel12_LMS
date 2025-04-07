<x-layouts.app title="Add Course">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div
            class="relative h-full flex-1 py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Add Course</h2>
            @session('error')
                <p class="my-4 text-red-500">{{ session('error') }}</p>
            @endsession
            @session('success')
                <p class="my-4 text-green-500">{{ session('success') }}</p>
            @endsession
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <flux:input label="Course Name *" name="course_name" required autofocus type="text"
                        placeholder="Enter Course Name" class="w-full mb-4" />
                    <flux:select label="Instructor *" name="user_id" type="text" placeholder="Choose Instructor"
                        class="w-full mb-4">
                        @php
                            $users = \App\Models\User::where('role', 'instructor')->get();
                        @endphp
                        @foreach ($users as $user)
                            <flux:select.option value="{{ $user->id }}">
                                {{ $user->first_name . ' ' . $user->last_name }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:select label="Category *" name="category_id" type="text" placeholder="Choose a Category"
                        class="w-full mb-4">
                        @php
                            $categories = \App\Models\Category::all();
                        @endphp
                        @foreach ($categories as $category)
                            <flux:select.option value="{{ $category->id }}">
                                {{ $category->category_name }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:textarea label="Short Description *" required name="short_desc" type="text"
                        placeholder="Enter a Short Description" class="w-full mb-4" />
                    <flux:textarea label="Long Description" name="long_desc" type="text"
                        placeholder="Enter a Long Description" class="w-full mb-4" />
                    <flux:input label="Course Scheme (Comma seperated) *" name="scheme" required type="text"
                        placeholder="Introduction, setting up, ...." class="w-full mb-4" />
                    <flux:input label="Course Requirements (Comma seperated) *" name="requirements" required
                        type="text" placeholder="Laptop, Internet, ...." class="w-full mb-4" />
                    <flux:input label="Duration *" name="duration" required type="text" placeholder="2h 45m"
                        class="w-full mb-4" />
                    <flux:input label="Thumbnail *" name="thumbnail" required type="file" accept="image/*"
                        placeholder="Choose Thumbnail" class="w-full mb-4" />
                    <flux:input label="Price (₦) *" name="price" required type="number" placeholder="5000"
                        class="w-full mb-4" />
                    <flux:button icon="plus" type="submit">Add Course</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
