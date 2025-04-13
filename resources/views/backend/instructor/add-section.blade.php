<x-layouts.app title="Add Section">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="relative  py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Add Section (For - {{ $course->course_name }})</h2>
            @session('error')
                <p class="my-4 text-red-500">{{ session('error') }}</p>
            @endsession
            @session('success')
                <p class="my-4 text-green-500">{{ session('success') }}</p>
            @endsession
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <flux:input label="Section Title" name="section_name" required autofocus type="text"
                        placeholder="Enter Section Title" class="w-full mb-4" />


                    <flux:button icon="plus" type="submit">Add Section</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
