<x-admin-layout>
    <div class="bg-white p-8 rounded-md w-full">
        <div class=" flex items-center justify-between pb-6">
            <div>
                <h2 class="text-gray-600 font-semibold">Categorias de servicios</h2>
                <span class="text-xs">Listado de Categorias de servicios</span>
            </div>
            <div>
                <x-button-route href="{{ route('admin.crearCategoria') }}" value="Crear una nueva categoria"/>
            </div>
        </div>
        @livewire('admin.busqueda-categoria')
</x-admin-layout>
