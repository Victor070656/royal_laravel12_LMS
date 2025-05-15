<x-layouts.app title="Edit Section Content">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="relative  py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Edit Content </h2>
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
                    <flux:input label="Title" name="title" value="{{ $courseContent->title }}" required autofocus
                        type="text" placeholder="Enter Title" class="w-full mb-4" />
                    <label for="type" class="mb-4 font-semibold text-sm">Content Type</label>
                    <select name="type" id="type" required
                        class="w-full text-sm mb-4 p-3 bg-neutral-200 text-neutral-600 dark:text-neutral-200 dark:bg-neutral-700  rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-300">
                        <option class="bg-neutral-200 text-neutral-600 dark:text-neutral-200 dark:bg-neutral-700"
                            value="" hidden disabled selected>
                            Choose a Content Type
                        </option>
                        @php
                            $categories = ['video', 'material'];
                        @endphp
                        @foreach ($categories as $category)
                            <option class="bg-neutral-200 text-neutral-600 dark:text-neutral-200 dark:bg-neutral-700"
                                value="{{ $category }}" {{ $courseContent->type == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    <flux:input label="Link" value="{{ $courseContent->link }}" name="link" required autofocus
                        type="url" placeholder="Enter Link" class="w-full mb-4" />

                    <flux:button icon="plus" type="submit">Edit Content</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
