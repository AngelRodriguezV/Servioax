<div class="grid gap-4 mt-4">
    {{-- Domingo --}}
    <form wire:submit="save('Domingo')">
        <div>
            <x-input type="text" wire:model="do_state.dia_semana" disabled />
            @isset($do_state['id'])
                <x-danger-button type="button" wire:click="delete('Domingo')">Eliminar</x-danger-button>
            @else
                <x-button type="submit">Guardar</x-button>
            @endisset
        </div>
    </form>
    {{-- Lunes --}}
    <form wire:submit="save('Lunes')">
        <div>
            <x-input type="text" wire:model="lu_state.dia_semana" disabled />
            @isset($lu_state['id'])
                <x-danger-button type="button" wire:click="delete('Lunes')">Eliminar</x-danger-button>
            @else
                <x-button type="submit">Guardar</x-button>
            @endisset
        </div>
    </form>
    {{-- Martes --}}
    <form wire:submit="save('Martes')">
        <div>
            <x-input type="text" wire:model="ma_state.dia_semana" disabled />
            @isset($ma_state['id'])
                <x-danger-button type="button" wire:click="delete('Martes')">Eliminar</x-danger-button>
            @else
                <x-button type="submit">Guardar</x-button>
            @endisset
        </div>
    </form>
    {{-- Miercoles --}}
    <form wire:submit="save('Miercoles')">
        <div>
            <x-input type="text" wire:model="mi_state.dia_semana" disabled />
            @isset($mi_state['id'])
                <x-danger-button type="button" wire:click="delete('Miercoles')">Eliminar</x-danger-button>
            @else
                <x-button type="submit">Guardar</x-button>
            @endisset
        </div>
    </form>
    {{-- Jueves --}}
    <form wire:submit="save('Jueves')">
        <div>
            <x-input type="text" wire:model="ju_state.dia_semana" disabled />
            @isset($ju_state['id'])
                <x-danger-button type="button" wire:click="delete('Jueves')">Eliminar</x-danger-button>
            @else
                <x-button type="submit">Guardar</x-button>
            @endisset
        </div>
    </form>
    {{-- Viernes --}}
    <form wire:submit="save('Viernes')">
        <div>
            <x-input type="text" wire:model="vi_state.dia_semana" disabled />
            @isset($vi_state['id'])
                <x-danger-button type="button" wire:click="delete('Viernes')">Eliminar</x-danger-button>
            @else
                <x-button type="submit">Guardar</x-button>
            @endisset
        </div>
    </form>
    {{-- Sabado --}}
    <form wire:submit="save('Sabado')">
        <div>
            <x-input type="text" wire:model="sa_state.dia_semana" disabled />
            @isset($sa_state['id'])
                <x-danger-button type="button" wire:click="delete('Sabado')">Eliminar</x-danger-button>
            @else
                <x-button type="submit">Guardar</x-button>
            @endisset
        </div>
    </form>

    <div>Horarios</div>
    <div class="grid gap-4">
        <form wire:submit="saveTime()">
            <div class="grid grid-cols-3 gap-1">
                <x-select-input-normal aria-label="dia_semana" :options="$dias" wire:model="new_time.dia_trabajo_id"
                    required />
                <x-input type="time" wire:model="new_time.hora_apertura" required />
                <x-input type="time" wire:model="new_time.hora_cierre" required />
                <x-button type="submit">Crear</x-button>
            </div>
        </form>
        @foreach ($horarios as $hora)
            <form wire:submit="updateHorario('{{ $hora->id }}')">
                <div class="grid grid-cols-3 gap-1">
                    <x-select-input-normal aria-label="dia_semana" :options="$dias"
                        wire:model="edit_time.{{ $hora->id }}.dia_trabajo_id" />
                    <x-input type="time" wire:model="edit_time.{{ $hora->id }}.hora_apertura" required />
                    <x-input type="time" wire:model="edit_time.{{ $hora->id }}.hora_cierre" required />
                    <x-button type="submit">Actualizar</x-button>
                    <x-danger-button type="button"
                        wire:click="deleteHorario('{{ $hora->id }}')">Eliminar</x-danger-button>
                </div>
            </form>
        @endforeach
    </div>

    <div id="bottom-banner" tabindex="-1"
        class="fixed bottom-0 start-0 z-50 flex justify-between w-full p-4 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center mx-auto">
            @if (session()->has('message'))
                <div class="text-green-500">{{ session('message') }}</div>
            @endif

            @if (session()->has('error'))
                <div class="text-red-500">{{ session('error') }}</div>
            @endif
        </div>
        <div class="flex items-center">
            <button data-dismiss-target="#bottom-banner" type="button" class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close banner</span>
            </button>
        </div>
    </div>

</div>
