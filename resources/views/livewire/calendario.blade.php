<div class="w-[370px]">

    <div class="grid grid-cols-3 font-bold text-center">
        <i wire:click="decrementar()" class="bg-blue-500"></i>
        <div>{{ $currentDateTime->format('M-Y') }}</div>
        <i wire:click="incrementar()" class="bg-blue-500"></i>
    </div>

    <div class="grid grid-cols-7 my-2 py-3 text-center border-2 rounded-xl shadow-lg">
        @foreach ($etiquetaDias as $diaSemana)
            <div>{{ $diaSemana }}</div>
        @endforeach
    </div>

    <div class="grid grid-cols-7 gap-[2px] overflow-hidden bg-gray-200 border-gray-200 border-2 rounded-xl shadow-lg">
        @php
            $extraClass = '';
        @endphp
        @while ($inicioCalendario <= $finCalendario)
            @php
                $extraClass = $inicioCalendario->format('m') != $currentDateTime->format('m') ? 'text-gray-400 ' : '';
                $extraClass .=
                    $inicioCalendario->format('Y-m-d') < $fecha->format('Y-m-d')
                        ? ''
                        : 'text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100';
            @endphp

            <div>
                <input type="radio" id="f-{{ $inicioCalendario->format('Y-m-d') }}" name="fecha" value="{{ $inicioCalendario->format('Y-m-d') }}"
                    class="hidden peer" required
                    {{ $inicioCalendario->format('Y-m-d') < $fecha->format('Y-m-d') ? 'disabled' : '' }}/>
                <label for="f-{{ $inicioCalendario->format('Y-m-d') }}"
                    class="inline-flex items-center justify-between w-full p-5 {{ $extraClass }}">
                    <div class="block">
                        <p>
                            {{ $inicioCalendario->format('j') }}
                        </p>
                    </div>
                </label>
            </div>{{--
            <button type="button" class="py-4 {{ $extraClass }}"
                {{ $inicioCalendario->format('Y-m-d') < $fecha->format('Y-m-d') ? 'disabled' : '' }}>
                <time class="rounded-full block mx-2 py-1">{{ $inicioCalendario->format('j') }}</time>
            </button>
            --}}
            @php
                $inicioCalendario->addDay();
            @endphp
        @endwhile
    </div>
</div>
