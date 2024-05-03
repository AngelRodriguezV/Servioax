<x-prov-layout>
    <form action="{{ route('proveedor.servicios.store') }}" method="POST" enctype="multipart/form-data">
        @include('proveedor.servicios.form')
        <div class="flex items-center justify-center w-full mt-3">
            <x-button>
                Guardar servicio
            </x-button>
        </div>
    </form>
</x-prov-layout>