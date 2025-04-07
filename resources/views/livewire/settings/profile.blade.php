<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public $photo = null;
    public string $phone = '';
    public string $bio = '';
    public string $gender = '';
    public string $address = '';
    public string $city = '';
    public string $country = '';
    public int $day = 0;
    public string $month = '';
    public int $year = 0;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->first_name = Auth::user()->first_name;
        $this->last_name = Auth::user()->last_name;
        $this->email = Auth::user()->email;
        $this->photo = Auth::user()->photo;
        $this->phone = Auth::user()->phone ?? '';
        $this->bio = Auth::user()->bio ?? '';
        $this->gender = Auth::user()->gender ?? '';
        $this->address = Auth::user()->address ?? '';
        $this->city = Auth::user()->city ?? '';
        $this->country = Auth::user()->country ?? '';
        $this->day = Auth::user()->day ?? 0;
        $this->month = Auth::user()->month ?? '';
        $this->year = Auth::user()->year ?? 0;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();
        // dd(is_string($this->photo));
        if (isset($this->photo) && !is_string($this->photo)) {
            $validated = $this->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
                'photo' => ['nullable', 'image', 'max:2048'], // Adjust max as needed
                'phone' => ['nullable', 'string', 'max:255'],
                'bio' => ['nullable', 'string'],
                'gender' => ['nullable', 'string'],
                'address' => ['nullable', 'string'],
                'city' => ['nullable', 'string'],
                'country' => ['nullable', 'string'],
                'day' => ['nullable', 'integer'],
                'month' => ['nullable', 'string'],
                'year' => ['nullable', 'integer'],
            ]);

            if ($this->photo) {
                $validated['photo'] = $this->photo->store('photos', 'public'); // Store in storage/app/public/photos
            } else {
                $validated['photo'] = $user->photo;
            }
        } else {
            $validated = $this->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
                'phone' => ['nullable', 'string', 'max:255'],
                'bio' => ['nullable', 'string'],
                'gender' => ['nullable', 'string'],
                'address' => ['nullable', 'string'],
                'city' => ['nullable', 'string'],
                'country' => ['nullable', 'string'],
                'day' => ['nullable', 'integer'],
                'month' => ['nullable', 'string'],
                'year' => ['nullable', 'integer'],
            ]);
        }
        // dd($validated['photo']);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        $this->reset('photo');

        $this->dispatch('profile-updated', name: $user->first_name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" enctype="multipart/form-data" class="my-6 w-full space-y-6">
            <flux:input wire:model="first_name" :label="__('First Name')" type="text" required autofocus
                autocomplete="first_name" />
            <flux:input wire:model="last_name" :label="__('Last Name')" type="text" required autofocus
                autocomplete="last_name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer"
                                wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>
            <flux:input wire:model="photo" :label="__('Profile Photo')" type="file" autocomplete="photo" />
            @if ($photo instanceof \Livewire\TemporaryUploadedFile)
                <img src="{{ $photo->temporaryUrl() }}" class="h-16 w-16 rounded-full mt-2">
            @elseif (auth()->user()->photo)
                <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="h-16 w-16 rounded-full mt-2">
            @endif
            <div class="py-3" wire:loading wire:target="photo">
                <span class="text-green-500 text-xs">Loading....</span>
            </div>
            <flux:input wire:model="phone" :label="__('Phone Number')" type="text" autocomplete="phone" />
            <flux:textarea wire:model="bio" :label="__('Bio')" type="text" autocomplete="bio" />
            {{-- <flux:input wire:model="gender" :label="__('Gender')" type="text" autocomplete="gender" /> --}}
            <flux:text class="mb-2">Gender</flux:text>
            <flux:select wire:model="gender">
                <flux:select.option value="male">male</flux:select.option>
                <flux:select.option value="female">female</flux:select.option>
            </flux:select>
            <flux:input wire:model="address" :label="__('Address')" type="text" autocomplete="address" />
            <flux:input wire:model="city" :label="__('City')" type="text" autocomplete="city" />
            <flux:input wire:model="country" :label="__('Country')" type="text" autocomplete="country" />
            <flux:input wire:model="day" :label="__('Day Of Birth')" type="text" autocomplete="day" />
            <flux:input wire:model="month" :label="__('Month Of Birth')" type="text" autocomplete="month" />
            <flux:input wire:model="year" :label="__('Year Of Birth')" type="text" autocomplete="year" />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
