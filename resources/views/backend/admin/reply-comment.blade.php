<x-layouts.app title="Reply Comment">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="relative py-6 px-4 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <form action="{{ route('manager.comment.reply', $comment) }}" method="post">
                @csrf
                @method('PATCH')
                <flux:textarea label="Write a Reply" name="reply" class="mb-3" >{{$comment->reply}}</flux:textarea>
                <flux:button type="submit" class="cursor-pointer" size="sm" variant="primary">
                    Submit
                </flux:button>
            </form>
        </div>
    </div>
</x-layouts.app>
