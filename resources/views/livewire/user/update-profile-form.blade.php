<x-form-section submit="updateProfile">
    <x-slot name="title">
        Informacion de perfil
    </x-slot>

    <x-slot name="description">
        Actualiza tu informacion personal
    </x-slot>

    <x-slot name="form">

        {{-- Nombre --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nombre" value="Nombre" />
            <x-input id="nombre" type="text" class="mt-1 block w-full" wire:model="state.nombre" required autocomplete="nombre" />
            <x-input-error for="nombre" class="mt-2" />
        </div>
        {{-- Apellido Paterno --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="apellido_paterno" value="Apellido paterno" />
            <x-input id="apellido_paterno" type="text" class="mt-1 block w-full" wire:model="state.apellido_paterno" required autocomplete="apellido_paterno" />
            <x-input-error for="apellido_paterno" class="mt-2" />
        </div>
        {{-- Apellido Materno --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="apellido_materno" value="Apellido materno" />
            <x-input id="apellido_materno" type="text" class="mt-1 block w-full" wire:model="state.apellido_materno" required autocomplete="apellido_materno" />
            <x-input-error for="apellido_materno" class="mt-2" />
        </div>
        {{-- Email --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />
        </div>
        {{-- Telefono --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="telefono" value="Telefono" />
            <x-input id="telefono" type="tel" class="mt-1 block w-full" wire:model="state.telefono" required />
            <x-input-error for="telefono" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
