<x-admin-layout>
    <div class="bg-white p-8 rounded-md w-full">
        <div class=" flex items-center justify-between pb-6">
            <div>
                <h2 class="text-gray-600 font-semibold">Categorias de servicios</h2>
                <span class="text-xs">Listado de Categorias de servicios</span>
            </div>
            <div>
                <span class="rounded-md bg-black px-4 py-2 text-white mt-4"><a href="{{ route('admin.crearCategoria') }}">Crear una nueva categoria</a></span>
            </div>
        </div>
        @livewire('admin.busqueda-categoria')
</x-admin-layout>
