<div class="grid gap-4 mt-4">
    {{-- Domingo --}}
    <form wire:submit="save('Domingo')">
        <div>
            <x-input type="text" wire:model="do_state.dia_semana" disabled />
            <x-input type="time" wire:model="do_state.hora_apertura" required />
            <x-input type="time" wire:model="do_state.hora_cierre" required />
            <x-input type="text" wire:model="do_state.Notas"  />
            <x-button type="submit">Guardar</x-button>
            @isset($do_state['id'])
                <x-danger-button type="button" wire:click="delete('Domingo')">Eliminar</x-danger-button>
            @endisset
        </div>
    </form>
    {{-- Lunes --}}
    <form wire:submit="save('Lunes')">
        <div>
            <x-input type="text" wire:model="lu_state.dia_semana" disabled />
            <x-input type="time" wire:model="lu_state.hora_apertura" required />
            <x-input type="time" wire:model="lu_state.hora_cierre" required />
            <x-input type="text" wire:model="lu_state.Notas"  />
            <x-button type="submit">Guardar</x-button>
            @isset($lu_state['id'])
                <x-danger-button type="button" wire:click="delete('Lunes')">Eliminar</x-danger-button>
            @endisset
        </div>
    </form>
    {{-- Martes --}}
    <form wire:submit="save('Martes')">
        <div>
            <x-input type="text" wire:model="ma_state.dia_semana" disabled />
            <x-input type="time" wire:model="ma_state.hora_apertura" required />
            <x-input type="time" wire:model="ma_state.hora_cierre" required />
            <x-input type="text" wire:model="ma_state.Notas"  />

            <x-button type="submit">Guardar</x-button>
            @isset($ma_state['id'])
                <x-danger-button type="button" wire:click="delete('Martes')">Eliminar</x-danger-button>
            @endisset
        </div>
    </form>
    {{-- Miercoles --}}
    <form wire:submit="save('Miercoles')">
        <div>
            <x-input type="text" wire:model="mi_state.dia_semana" disabled />
            <x-input type="time" wire:model="mi_state.hora_apertura" required />
            <x-input type="time" wire:model="mi_state.hora_cierre" required />
            <x-input type="text" wire:model="mi_state.Notas"  />

            <x-button type="submit">Guardar</x-button>
            @isset($mi_state['id'])
                <x-danger-button type="button" wire:click="delete('Miercoles')">Eliminar</x-danger-button>
            @endisset
        </div>
    </form>
    {{-- Jueves --}}
    <form wire:submit="save('Jueves')">
        <div>
            <x-input type="text" wire:model="ju_state.dia_semana" disabled />
            <x-input type="time" wire:model="ju_state.hora_apertura" required />
            <x-input type="time" wire:model="ju_state.hora_cierre" required />
            <x-input type="text" wire:model="ju_state.Notas"  />

            <x-button type="submit">Guardar</x-button>
            @isset($ju_state['id'])
                <x-danger-button type="button" wire:click="delete('Jueves')">Eliminar</x-danger-button>
            @endisset
        </div>
    </form>
    {{-- Viernes --}}
    <form wire:submit="save('Viernes')">
        <div>
            <x-input type="text" wire:model="vi_state.dia_semana" disabled />
            <x-input type="time" wire:model="vi_state.hora_apertura" required />
            <x-input type="time" wire:model="vi_state.hora_cierre" required />
            <x-input type="text" wire:model="vi_state.Notas"  />

            <x-button type="submit">Guardar</x-button>
            @isset($vi_state['id'])
                <x-danger-button type="button" wire:click="delete('Viernes')">Eliminar</x-danger-button>
            @endisset
        </div>
    </form>
    {{-- Sabado --}}
    <form wire:submit="save('Sabado')">
        <div>
            <x-input type="text" wire:model="sa_state.dia_semana" disabled />
            <x-input type="time" wire:model="sa_state.hora_apertura" required />
            <x-input type="time" wire:model="sa_state.hora_cierre" required />
            <x-input type="text" wire:model="sa_state.Notas"  />

            <x-button type="submit">Guardar</x-button>
            @isset($sa_state['id'])
                <x-danger-button type="button" wire:click="delete('Sabado')">Eliminar</x-danger-button>
            @endisset
        </div>
    </form>
</div>
