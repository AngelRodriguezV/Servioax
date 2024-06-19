<div class="text-center p-4">
    <!-- Dropdown for selecting month -->
    <div class="mb-4">
        <label for="month-select" class="block mb-2">Selecciona un mes:</label>
        <select id="month-select" wire:model="selectedMonth" class="p-2 border border-gray-300 rounded-md">
            @foreach ($nextMonths as $month)
                <option value="{{ $month['value'] }}">{{ $month['name'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-2 gap-2 font-bold text-center">
        <i wire:click="decrementar()" class="bg-gray-200 hover:bg-blue-600 hover:text-white rounded-md">
            <svg class="w-8 h-8 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 12H20M4 12L8 8M4 12L8 16" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </i>
        <i wire:click="incrementar()" class="bg-gray-200 hover:bg-blue-600 hover:text-white rounded-md">
            <svg class="w-8 h-8 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </i>
    </div>

    <div class="grid grid-flow-col overflow-x-scroll">
        @while ($inicioCalendario <= $finCalendario)
            @if ($inicioCalendario->format('y-m-d') >= $currentDateTime->format('y-m-d'))
                <div class="h-full grid gap-1 p-2 w-40">
                    <div>
                        {{ $semanas[$inicioCalendario->format('N')] }} {{ $inicioCalendario->format('d') }}
                        {{ $meses[$inicioCalendario->format('n')] }}
                    </div>
                    @for ($i = 0; $i < 15; $i++)
                        <div>
                            @php
                                $hi = Carbon\Carbon::now()->setTime($i + 6, 0, 0);
                                $hf = Carbon\Carbon::now()->setTime($i + 7, 0, 0);
                                $extraClass = ' ';
                                $color = ' bg-gray-200';
                                $active = false;
                                foreach ($horasDisponibles as $hora) {
                                    if (strval($hora->diaTrabajo->N) === $inicioCalendario->format('N')) {
                                        if (
                                            $hi->format('H:i') >= $hora->hora_apertura->format('H:i') && $hi->format('H:i') < $hora->hora_cierre->format('H:i') &&
                                            $hf->format('H:i') <= $hora->hora_cierre->format('H:i') && $hf->format('H:i') > $hora->hora_apertura->format('H:i')
                                        ) {
                                            $color = ' bg-green-200';
                                            $active = true;
                                            $extraClass = 'hover:bg-blue-600 hover:text-white';
                                            break;
                                        }
                                    }
                                }
                                foreach ($horasOcupadas as $hora) {
                                    if ($hora->fecha->format('Y-m-d') === $inicioCalendario->format('Y-m-d')) {
                                        if (
                                            $hi->format('H:i') >= $hora->hora_inicio->format('H:i') && $hi->format('H:i') < $hora->hora_termino->format('H:i') &&
                                            $hf->format('H:i') <= $hora->hora_termino->format('H:i') && $hf->format('H:i') > $hora->hora_inicio->format('H:i')
                                        ) {
                                            $color = ' bg-red-200';
                                            $active = false;
                                            $extraClass = ' ';
                                            break;
                                        }
                                    }
                                }
                                $extraClass .= $color;
                            @endphp
                            <button type="button"
                                class="p-1 w-full rounded-md border border-gray-200 text-gray-500 {{ $extraClass }}"
                                wire:click="select('{{$inicioCalendario->format('Y-m-d')}}/{{$hi->format('H:i:s')}}/{{$hf->format('H:i:s')}}')"
                                {{ $active ? ' ' : 'disabled' }}>
                                {{ $hi->format('H:i') }} - {{ $hf->format('H:i') }}
                            </button>
                        </div>
                    @endfor
                </div>
            @endif
            @php
                $inicioCalendario->addDay();
            @endphp
        @endwhile
        <input type="text" name="date-times" wire:model="value" aria-label="date time" required hidden>
    </div>
    <x-dialog-modal wire:model.live="modal">
        <x-slot name="title">
            Selección del horario
        </x-slot>
        <x-slot name="content">
            <p>Deseas guardar el horario seleccionado:</p>
            <p>Fecha: {{ $value[0] }}</p>
            <p>Hora inicio: {{ $value[1] }}</p>
            <p>Hora cierre: {{ $value[2] }}</p>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="cancel()">
                Cancelar
            </x-secondary-button>

            <x-button class="ms-3">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
