<div class="text-center p-4">

    <div class="grid grid-cols-2 gap-2 font-bold text-center">
        <i wire:click="decrementar()" class="bg-white hover:bg-blue-600 hover:text-white rounded-md">
            <svg class="w-8 h-8 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 12H20M4 12L8 8M4 12L8 16" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </i>
        <i wire:click="incrementar()" class="bg-white hover:bg-blue-600 hover:text-white rounded-md">
            <svg class="w-8 h-8 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </i>
    </div>

    <div class="grid grid-flow-col overflow-x-scroll gap-2 mt-2 p-2">
        @while ($inicioCalendario <= $finCalendario)

            @if ($inicioCalendario->format('y-m-d') >= $currentDateTime->format('y-m-d'))
                <div class="h-full grid gap-1 p-2 w-80 bg-white rounded-md">
                    <div>
                        {{ $semanas[$inicioCalendario->format('N')] }} {{ $inicioCalendario->format('d') }}
                        {{ $meses[$inicioCalendario->format('n')] }}
                    </div>
                    @foreach ($horasOcupadas as $solicitud)
                        @if ($inicioCalendario->format('Y-m-d') === $solicitud->fecha->format('Y-m-d'))
                            <div>
                                @php
                                    $extraClass = 'cursor-pointer hover:text-white hover:bg-blue-600';
                                    $color = ' bg-white';
                                    switch ($solicitud->estatus) {
                                        case 'NUEVA':
                                            $color = ' bg-blue-200';
                                            break;
                                        case 'ACEPTADA':
                                            $color = ' bg-green-200';
                                            break;
                                        case 'EN REVISION':
                                            $color = ' bg-yellow-200';
                                            break;
                                        case 'EN PROCESO':
                                            $color = ' bg-cyan-200';
                                            break;
                                        case 'COMPLETADA':
                                            $color = ' bg-violet-200';
                                            break;
                                        default:
                                            $color = ' bg-red-200';
                                            break;
                                    }
                                    $extraClass .= $color;
                                @endphp

                                <a href="{{ route('proveedor.aprobar', $solicitud) }}"
                                    class="w-full block p-1 rounded-md border border-gray-200 text-gray-500 {{ $extraClass }}">
                                    <div>
                                        {{ $solicitud->hora_inicio->format('H:i') }} -
                                        {{ $solicitud->hora_termino->format('H:i') }}
                                    </div>
                                    <div>
                                        Servicio: {{ $solicitud->servicio->nombre }}
                                    </div>
                                    <div>
                                        Cliente: {{ $solicitud->cliente->nombre }}
                                    </div>
                                    <div>
                                        Estatus: {{ $solicitud->estatus }}
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
            @php
                $inicioCalendario->addDay();
            @endphp
        @endwhile
    </div>
</div>
