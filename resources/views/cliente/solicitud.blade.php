<x-guest-layout>

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
                    Proveedor: <span class="font-normal">{{ $solicitud->servicio->proveedor->nombre }}</span>
                </p>
                <p class="font-bold mt-2">
                    Categoria: <span class="font-normal">{{ $solicitud->servicio->categoria->nombre }}</span>
                </p>
                <p class="mt-2 rounded-lg p-2 w-32 bg-gray-300 text-center">
                    {{ $solicitud->estatus }}
                </p>
                {{ $solicitud->id }}
            </div>
        </div>
        <div class="grid gap-2 mt-4 p-2 border-2 rounded-lg border-gray-200">
            <p>Dirección</p>
            <div>
                Calle: <span>{{ $solicitud->direccion->calle }}</span>
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
        </div>
        <div class="mt-4">
            <a href="{{ route('messenger', $solicitud->servicio->proveedor) }}" class="p-2 border-2 border-gray-200 rounded-lg hover:bg-blue-500">
                Mandale mensaje al proveedor de servicio
            </a>
        </div>

        @livewire('cliente.valoracion-form', ['solicitud' => $solicitud])
    </div>

</x-guest-layout>
