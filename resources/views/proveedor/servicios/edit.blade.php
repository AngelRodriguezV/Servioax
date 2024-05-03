@props(['servicio'])
<x-prov-layout>
    <!--Cambiar store por update-->
    <form action="{{ route('proveedor.servicios.update', $servicio) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('proveedor.servicios.form')
        <div class="flex items-center justify-center w-full mt-3">
            <x-button>
                Guardar servicio
            </x-button>
        </div>
    </form>
</x-prov-layout>