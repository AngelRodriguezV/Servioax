<div class="grid grid-cols-1 lg:grid-cols-4 px-16 p-4 gap-2">
    @foreach ($proveedores as $proveedor)
        <x-cards.proveedor :proveedor="$proveedor" />
    @endforeach
</div>
