<div>
    <x-button>
        <a href="{{ route('proveedor.servicios.edit', $servicio) }}">
            Editar
        </a>
    </x-button>
    <x-danger-button wire:click="confirmDelete" wire:loading.attr="disabled">Eliminar</x-danger-button>

    <x-dialog-modal wire:model.live="confirmingDelete">
        <x-slot name="title">
            Eliminar Servicio
        </x-slot>
        <x-slot name="content">
            Estas seguro de eliminar el servicio: {{ $servicio->nombre }}
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingDelete')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteServicio" wire:loading.attr="disabled">
                Eliminar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
