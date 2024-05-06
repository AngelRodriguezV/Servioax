<x-guest-layout>

    <div class="w-4/5 mx-auto py-6">

        <h1>
            Solicitud del servicio {{ $servicio->nombre }}
        </h1>

        <form method="GET" action="{{ route('cliente.solicitud.show') }}" class="grid">
            <input type="text" name="servicio_id" value="{{$servicio->id}}" hidden>

            @livewire('calendario')
            <input type="time" name="hora" id="hora" required>

            <label for="direccion">Selecciona una dirección</label>
            <ul class="grid w-full gap-6 md:grid-cols-2">
                @foreach ($direcciones as $direccion)

                    <li>
                        <input type="radio" id="direccion-{{ $direccion->id }}" name="direccion" value="{{ $direccion->id }}" class="hidden peer"
                            required />
                        <label for="direccion-{{ $direccion->id }}"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                            <div class="block">
                                <p>
                                    {{ $direccion->calle}} {{ $direccion->num_exterior }}
                                </p>
                                <p>
                                    Codigo postal {{$direccion->codigo_postal}} - {{$direccion->estado}} - {{$direccion->municipio}} - {{$direccion->colonia}}
                                </p>
                            </div>
                        </label>
                    </li>
                @endforeach
            </ul>


            <button>Guardad</button>
        </form>
    </div>
</x-guest-layout>