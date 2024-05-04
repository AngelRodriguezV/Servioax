<div class="grid lg:grid-cols-3 gap-4 mt-4">
    <div>
        <button data-modal-target="direccion-create" data-modal-toggle="direccion-create"
            class="p-2 bg-gray-50 rounded-lg border-2 hover:border-green-500 h-full w-full place-content-center "
            type="button">
            <x-icons.add class="hover:text-green-500 w-52 h-52 mx-auto" />
            <p>Nueva dirección</p>
        </button>
    </div>
    @foreach ($direcciones as $direccion)
        <div class="grid gap-2 p-4 px-4 w-full bg-gray-50 rounded-xl shadow-md border-2 hover:border-blue-500">
            <div>
                Calle:
                <span>{{ $direccion->calle }}</span>
            </div>
            <div>
                Numero exterior:
                <span>{{ $direccion->num_exterior }}</span>
            </div>
            <div>
                Numero interior:
                <span>{{ $direccion->num_interior }}</span>
            </div>
            <div>
                Colonia:
                <span>{{ $direccion->colonia }}</span>
            </div>
            <div>
                Municipio:
                <span>{{ $direccion->municipio }}</span>
            </div>
            <div>
                Estado:
                <span>{{ $direccion->estado }}</span>
            </div>
            <div>
                Codigo postal:
                <span>{{ $direccion->codigo_postal }}</span>
            </div>
            <div>
                Referencias:
                <span>{{ $direccion->referencias }}</span>
            </div>
            <div class="grid grid-cols-2 gap-2 text-center mt-2">
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                    class="p-2 bg-gray-200 rounded-lg border-2 hover:border-green-500" type="button">
                    Editar
                </button>
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                    class="p-2 bg-gray-200 rounded-lg border-2 hover:border-red-500" type="button">
                    Eliminar
                </button>
            </div>
        </div>
    @endforeach

    @livewire('modal.direccion-create')
</div>
