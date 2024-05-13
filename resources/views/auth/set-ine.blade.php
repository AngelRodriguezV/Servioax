<x-login-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form action="{{ route('set-ine') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="mb-2 font-bold">Agrega tu INE</h2>
            <x-input-img size="ine"/>
            <x-button type="submit" class="my-4">Guardar</x-button>
        </form>

    </x-authentication-card>
</x-login-layout>
