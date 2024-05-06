@csrf
<div class="mt-4 grid gap-2">
    <x-label for="nombre">Nombre</x-label>
    <x-input type="text"
        id="nombre"
        name="nombre"
        value="{{ isset($servicio) ? $servicio->nombre : old('nombre') }}"
        placeholder="Ingrese el nombre del servicio"
        class="w-full"/>
    <x-input-error for="nombre"/>
</div>

<div class="mt-4 grid gap-2">
    <x-label for="descripcion">Descripcion</x-label>
    <textarea
        id="descripcion"
        name="descripcion"
        class="w-full text-slate-950 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        placeholder="Ingrese la descripcion del servicio">{{ isset($servicio) ? $servicio->descripcion : old('descripcion') }}</textarea>
    <x-input-error for="descripcion"/>
</div>

<div class="mt-4 grid gap-2">
    <x-label for="categoria">Categoria</x-label>
    <x-select-input id="categoria" name="categoria" class="w-full" :options="$categorias" :selected="isset($servicio) ? $servicio->categoria_id : old('categoria')" />
    <x-input-error for="categoria"/>
</div>

<div class="mt-4 grid gap-2">
    <x-label for="nombre">Imagen</x-label>
    <x-input-img :url="isset($servicio->image) ? $servicio->image->url : null" size="horizontal"/>
</div>

