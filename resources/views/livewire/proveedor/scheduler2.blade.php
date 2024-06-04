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
</div>
