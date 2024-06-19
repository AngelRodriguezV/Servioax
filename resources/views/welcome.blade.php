<x-guest-layout>
    <div class="py-6 mx-auto max-w-7xl px-2">
        <h2 class="text-2xl font-bold mt-4">Proveedores de servicio</h2>
        @livewire('components.carousel-proveedores')

        <h2 class="text-2xl font-bold mt-4">Categorias</h2>
        <!-- Carousel wrapper -->
        <div class="grid grid-cols-1 lg:grid-cols-4 px-16 p-4 gap-2">
            @foreach ($categorias as $categoria)
                <x-cards.categoria :categoria="$categoria"/>
            @endforeach
        </div>

        <h2 class="text-2xl font-bold">Servicios</h2>
        <x-carousel.servicios :servicios="$servicios" />
    </div>
</x-guest-layout>