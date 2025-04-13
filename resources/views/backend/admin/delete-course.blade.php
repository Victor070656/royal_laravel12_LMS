<x-layouts.app title="Delete Course">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div
            class="relative h-full flex-1 py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Delete Course</h2>
            <div class="py-30 text-center">
                <h2 class="text-xl">Are you sure you want to delete this course?</h2>
                <p class="mb-4">This action can't be undone.</p>
                <form action="{{ route('manager.course.delete', $course) }}" method="post">
                    @csrf
                    @method('delete')
                    <flux:button type="submit" variant="danger">Delete</flux:button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
