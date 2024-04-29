<x-prov-layout>
    <h1 class="text-center font-bold text-2xl pb-4">¡Bienvenido {{ $proveedors->nombre }}!</h1>
        
    <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-2">
        <x-cards.crearServicioProv :url="route('proveedor.servicios.create')" nombre="Servicio"/>
        @foreach ($servicios as $servicio)
            <x-cards.servicioProv :servicio="$servicio"/>
        @endforeach
    </div>
</x-prov-layout>
