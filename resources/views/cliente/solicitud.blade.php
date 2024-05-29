<x-cliente-layout>

    <div class="mx-auto max-w-7xl px-2 py-6">
        <div class="flex gap-4">
            <div>
                <img class="rounded-lg object-cover object-center w-72"
                    src="{{ Storage::url($solicitud->servicio->image ? $solicitud->servicio->image->url : 'image/Carpinteria.jpg') }}"
                    alt="" />
            </div>
            <div>
                <p class="font-bold mt-2">
                    Servicio: <span class="font-normal">{{ $solicitud->servicio->nombre }}</span>
                </p>
                <p class="font-bold mt-2">
                    Proveedor: <span class="font-normal">{{ $solicitud->servicio->proveedor->nombre . ' ' . $solicitud->servicio->proveedor->apellido_paterno . ' ' . $solicitud->servicio->proveedor->apellido_materno }}</span>
                </p>
                <p class="font-bold mt-2">
                    Categoria: <span class="font-normal">{{ $solicitud->servicio->categoria->nombre }}</span>
                </p>
                <p class="font-bold mt-2">
                    Fecha: <span class="font-normal">{{ $solicitud->fecha }}</span>
                </p>
                <p class="font-bold mt-2">
                    Hora inicio: <span class="font-normal">{{ $solicitud->hora_inicio }}</span>
                </p>
                <p class="font-bold mt-2">
                    Hora termino: <span class="font-normal">{{ $solicitud->hora_termino }}</span>
                </p>
                <p class="mt-2 rounded-lg px-3 py-2 text-center text-white font-bold {{$solicitud->estatus=='NUEVA'?'bg-blue-500':''}} {{$solicitud->estatus=='EN REVISION'?'bg-orange-500':''}} {{$solicitud->estatus=='ACEPTADA'?'bg-green-500':''}} {{$solicitud->estatus=='RECHAZADA'?'bg-red-500':''}} {{$solicitud->estatus=='CANCELADA'?'bg-red-500':''}} {{$solicitud->estatus=='COMPLETADA'?'bg-purple-500':''}}">
                    {{ $solicitud->estatus }}
                </p>
            </div>
        </div>
        <div class="grid gap-2 mt-4 p-2 border-2 rounded-lg border-gray-200">
            <p class="font-bold">Dirección</p>
            <div>
                Calle: <span>{{ $solicitud->direccion->calle }}</span>
            </div>
            <div>
                Numero exterior: <span>{{ $solicitud->direccion->num_exterior }}</span>
            </div>
            <div>
                Numero interior: <span>{{ $solicitud->direccion->num_interior }}</span>
            </div>
            <div>
                Colonia: <span>{{ $solicitud->direccion->colonia }}</span>
            </div>
            <div>
                Municipio: <span>{{ $solicitud->direccion->municipio }}</span>
            </div>
            <div>
                Estado: <span>{{ $solicitud->direccion->estado }}</span>
            </div>
            <div>
                Codigo Postal: <span>{{ $solicitud->direccion->codigo_postal }}</span>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('cliente.mensajes', $solicitud->servicio->proveedor) }}" class="p-2 border-2 bg-blue-300 border-gray-200 rounded-lg hover:bg-blue-500">
                Mandale mensaje al proveedor de servicio
            </a>
        </div>

        @livewire('cliente.valoracion-form', ['solicitud' => $solicitud])
    </div>

</x-cliente-layout>
