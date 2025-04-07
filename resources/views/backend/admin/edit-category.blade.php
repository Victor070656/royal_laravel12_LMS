<x-layouts.app title="Categories">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div
            class="relative h-full flex-1 py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Edit Category</h2>
            @session('error')
                <p class="my-4 text-red-500">{{ session('error') }}</p>
            @endsession
            @session('success')
                <p class="my-4 text-green-500">{{ session('success') }}</p>
            @endsession
            <form method="post">
                @csrf
                @method('put')
                <div class=" mb-5">
                    <flux:input label="Category Name *" name="category_name" type="text"
                        placeholder="Enter Category Name" value="{{$category->category_name}}" class="w-full mb-4" />

                    <flux:button icon="plus" type="submit">Update Category</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
