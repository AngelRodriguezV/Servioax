<x-admin-layout>
    <div class="mx-auto max-w-7xl px-2 py-6">
        @livewire('user.update-profile-form')
        <x-section-border />

        @livewire('user.update-photo-form')
        <x-section-border />

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>

            <x-section-border />
        @endif

        <div class="mt-10 sm:mt-0">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <x-section-border />
    @endif
    </div>
</x-admin-layout>
