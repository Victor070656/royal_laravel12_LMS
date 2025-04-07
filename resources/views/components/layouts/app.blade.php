@if (auth()->user()->isAdmin())
    <x-layouts.app.sidebar :title="$title ?? null">
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts.app.sidebar>
@elseif (auth()->user()->isInstructor())
    <x-layouts.app.sidebari :title="$title ?? null">
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts.app.sidebari>
@elseif (auth()->user()->isUser())
    <x-layouts.app.sidebars :title="$title ?? null">
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts.app.sidebars>
@endif
{{-- @if (request()->routeIs('settings*'))
@else
    <x-layouts.app.sidebar :title="$title ?? null">
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts.app.sidebar>
@endif --}}
