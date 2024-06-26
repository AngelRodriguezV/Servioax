<x-admin-layout>
    <div class="flex min-h-screen items-center justify-start">
        <div class="w-full max-w-lg">
            <h1 class="text-4xl font-medium">Editar categoria</h1>
            <p class="mt-3">Aqui puedes editar las categorias para los proveedores de servicios.</p>

            <form action="{{ route('admin.actualizarCategoria', $categoria) }}" method="POST" enctype="multipart/form-data" class="mt-10">
                @csrf
                @method('PUT')
                <div class="grid gap-6">
                    <div>
                        <x-label for="nombre">Nombre</x-label>
                        <x-input type="text" id="nombre" name="nombre"
                            value="{{ isset($categoria) ? $categoria->nombre : old('nombre') }}"
                            placeholder="Ingrese el nombre de la categoria" class="w-full" />
                        <x-input-error for="nombre" />
                    </div>
                    <div>
                        <x-label for="descripcion">Descripcion</x-label>
                        <textarea id="descripcion" name="descripcion"
                            class="w-full text-slate-950 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            placeholder="Ingrese la descripcion del servicio">{{ isset($categoria) ? $categoria->descripcion : old('descripcion') }}</textarea>
                        <x-input-error for="descripcion" />
                    </div>

                    <div class="mb-3">
                        <x-label for="nombre">Imagen</x-label>
                        <x-input-img :url="isset($categoria->image) ? $categoria->image->url : null" size="horizontal" />
                    </div>
                </div>
                <x-button type="submit">Crear categoría</x-button>
            </form>
        </div>
    </div>
</x-admin-layout>
