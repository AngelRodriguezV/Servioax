<div class="text-center p-4" x-on="{}">

    <div class="grid grid-cols-3 font-bold text-center">
        <i wire:click="decrementar()">
            <svg class="w-8 h-8 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 12H20M4 12L8 8M4 12L8 16" stroke="#000000" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </i>
        <i wire:click="incrementar()">
            <svg class="w-8 h-8 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#000000" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </i>
    </div>

    <div class="grid grid-flow-col overflow-x-scroll">
        @while ($inicioCalendario <= $finCalendario)

            @if ($inicioCalendario->format('y-m-d') >= $fecha->format('y-m-d'))
                <div class="h-full grid gap-1 p-2 w-40">
                    <div>
                        {{ $semanas[$inicioCalendario->format('N')]}} {{ $inicioCalendario->format('d') }} {{ $meses[$inicioCalendario->format('n')]}}
                    </div>
                    @for ($i = 0; $i < 15; $i++)
                        <div>
                            @php
                                $extraClass = $diasDisponibles->contains($inicioCalendario->format('N')) ? 'bg-white cursor-pointer peer-checked:border-blue-600 peer-checked:text-white peer-checked:bg-blue-600 hover:text-gray-600 hover:bg-gray-100' : 'bg-gray-200';
                            @endphp
                            <input type="radio" id="{{ $inicioCalendario->format('Y-m-d') }}-{{ $i }}"
                                name="fecha" class="hidden peer" {{ $diasDisponibles->contains($inicioCalendario->format('N')) ? ' ' : 'disabled' }} required/>
                            <label for="{{ $inicioCalendario->format('Y-m-d') }}-{{ $i }}"
                                class="inline-flex items-center justify-center w-full p-1 rounded-md border border-gray-200 text-gray-500 {{ $extraClass }}">
                                <div class="block">
                                    <p>
                                        {{ $i + 6 }} - {{ $i + 7 }}
                                    </p>
                                </div>
                            </label>
                        </div>
                    @endfor
                </div>
            @endif
            @php
                $inicioCalendario->addDay();
            @endphp
        @endwhile
    </div>
    <script></script>
</div>
