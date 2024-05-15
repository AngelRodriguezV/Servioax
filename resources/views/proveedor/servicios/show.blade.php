<x-prov-layout>
    <div class="mx-auto max-w-7xl px-2 py-6">
        <h1 class="font-bold text-xl">
            Mi servicio
        </h1>

        <div class="grid lg:grid-cols-2 py-4">
            <div class="mb-4 mx-4">
                <img class="h-auto max-w-full rounded-lg shadow-xl object-cover object-center"
                    src="{{ Storage::url($servicio->image ? $servicio->image->url : 'image/Carpinteria.jpg') }}" alt="image description">
            </div>
            <div>
                <div class="grid grid-cols-2 mb-4 font-bold">
                    Nombre: <span class="font-normal">{{ $servicio->nombre }}</span>
                </div>
                <div class="grid grid-cols-2 mb-4 font-bold">
                    Categoria: <span class="font-normal">{{ $servicio->categoria->nombre }}</span>
                </div>
                <div class="grid grid-cols-2 mb-4 font-bold">
                    Descripción: <span class="font-normal">{{ $servicio->descripcion }}</span>
                </div>
                <div class="grid grid-cols-2 mb-4 font-bold">
                    Estatus: <x-button-status :value="$servicio->estatus"/>
                </div>
                @livewire('proveedor.servicio-delete', ['servicio' => $servicio])

            </div>
        </div>

        @livewire('proveedor.servicio-solicitudes', ['servicio' => $servicio])

    </div>
</x-prov-layout>
