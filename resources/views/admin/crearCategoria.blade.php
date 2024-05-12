<x-admin-layout>
    <div class="flex min-h-screen items-center justify-start bg-white">
        <div class="mx-auto w-full max-w-lg">
            <h1 class="text-4xl font-medium">Crear una nueva categoria</h1>
            <p class="mt-3">Aqui puedes crear nuevas categorias para los proveedores de servicios.</p>


            <form action="{{ route('admin.storeCategoria') }}" method="POST" enctype="multipart/form-data" class="mt-10">
                @csrf
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="relative z-0">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
    
                    <div class="relative z-0">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
                    </div>

                    <div class="relative z-0">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" name="imagen" id="imagen" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary t-5 rounded-md bg-black px-10 py-2 text-white mt-4">Crear Categoría</button>
            </form>
        </div>
    </div>
</x-admin-layout>
