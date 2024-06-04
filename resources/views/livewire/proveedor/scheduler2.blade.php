<div class="text-center p-4">

    <div class="grid grid-flow-col overflow-x-scroll gap-2 mt-2 p-2">
        @foreach ($semanas as $semana)
            <div class="h-full grid gap-1 p-2 w-40">
                <div>
                    @php
                        $color = 'bg-blue-600 hover:bg-blue-400';
                        $funcion = 'crear';
                        $active = false;
                        foreach ($diasDisponibles as $dia) {
                            if ($dia->dia_semana == $semana) {
                                $color = 'bg-red-600 hover:bg-red-400';
                                $funcion = 'eliminar';
                                $active = true;
                                break;
                            }
                        }
                    @endphp
                    <button type="button" wire:click="{{ $funcion }}_dia('{{ $semana }}')"
                        class="w-full p-2 rounded-md text-white {{ $color }}">
                        {{ $semana }}
                    </button>
                </div>
                @for ($i = 0; $i < 15; $i++)
                    @php
                        $hi = Carbon\Carbon::now()->setTime($i + 6, 0, 0);
                        $hf = Carbon\Carbon::now()->setTime($i + 7, 0, 0);
                        $color2 = $active ? 'text-white bg-blue-600 hover:bg-blue-400' : 'bg-white';
                        $funcion2 = 'crear';
                        if ($active) {
                            foreach ($horasDisponibles as $hora) {
                                if ($hora->diaTrabajo->dia_semana == $semana) {
                                    if (
                                        $hi->format('H:i') >= $hora->hora_apertura->format('H:i') &&
                                        $hi->format('H:i') < $hora->hora_cierre->format('H:i') &&
                                        $hf->format('H:i') <= $hora->hora_cierre->format('H:i') &&
                                        $hf->format('H:i') > $hora->hora_apertura->format('H:i')
                                    ) {
                                        $funcion2 = 'eliminar';
                                        $color2 = 'text-white bg-red-600 hover:bg-red-400';
                                    }
                                }
                            }
                        }
                    @endphp
                    <div>
                        <button type="button" wire:click="{{ $funcion2 }}_hora('{{ $semana }}-{{ $hi->format('H:i') }}-{{ $hf->format('H:i') }}')"
                            class="w-full p-1 rounded-md {{ $color2 }}" {{ $active ? ' ' : 'disabled' }}>
                            {{ $hi->format('H:i') }} - {{ $hf->format('H:i') }}
                        </button>
                    </div>
                @endfor
            </div>
        @endforeach
    </div>
    <x-dialog-modal wire:model.live="hora_delete">
        <x-slot name="title">
            Eliminar Horario
        </x-slot>
        <x-slot name="content">
            <p>Estas seguro de eliminar el Horario:</p>
            {{ isset($hora_current) ? $hora_current->diaTrabajo->dia_semana . ' ' . $hora_current->hora_apertura->format('H:i') . '-' . $hora_current->hora_cierre->format('H:i') : ''}}
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('hora_delete')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteHora" wire:loading.attr="disabled">
                Eliminar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
    <x-dialog-modal wire:model.live="dia_delete">
        <x-slot name="title">
            Eliminar Dia
        </x-slot>
        <x-slot name="content">
            <p>Estas seguro de eliminar el Dia de la semana:</p>
            {{ isset($dia_current) ? $dia_current->dia_semana  : ''}}
            <p>Se eliminarán también todos los horarios asociados.</p>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('dia_delete')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteDia" wire:loading.attr="disabled">
                Eliminar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
