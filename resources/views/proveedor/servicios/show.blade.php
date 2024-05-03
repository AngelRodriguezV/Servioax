<x-prov-layout>
    <x-prov.info-servicio :servicio="$servicio"/>
    <div class="flex items-center justify-center w-full mt-3">
        <x-button>
            <a href="{{route('proveedor.servicios.edit', $servicio)}}">
                Editar Servicio
            </a>
        </x-button>
    </div>
</x-prov-layout>