<x-layouts.app title="Categories">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div
            class="relative h-full flex-1 py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-lg font-bold mb-4">Categories</h2>
            @session("error")
                <p class="my-4 text-red-500">{{ session("error") }}</p>
            @endsession
            @session("success")
                <p class="my-4 text-green-500">{{session("success")}}</p>
            @endsession
            <form method="post">
                @csrf
                <div class=" mb-5">
                    <flux:input label="Category Name *" name="category_name" type="text"
                        placeholder="Enter Category Name" class="w-full mb-4" />
                    
                    <flux:button icon="plus" type="submit">Add Category</flux:button>
                </div>
            </form>

            <div class="mt-5 overflow-y-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="font-semibold ">
                            <th scope="col" class="p-3">Category</th>
                            <th scope="col" class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                
                                <td class="p-3">{{ $category->category_name }}</td>
                                <td class="p-3">
                                <flux:button varient="primary" href="{{route('manager.categories.edit', $category)}}" wire:navigate>Edit</flux:button>
                                <flux:button varient="danger" href="#" wire:navigate>Delete</flux:button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
