<x-prov-layout>
    <h1 class="text-center font-bold text-2xl pb-4">¡Bienvenido {{ Auth::user()->nombre }}!</h1>

    @livewire('proveedor.servicio-home')

</x-prov-layout>
