<div>

    <div class="grid lg:flex gap-2 my-4">
        <x-search wire:model.live="search" />
        <div class="relative">
            <label for="estatus" class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">Estatus:</label>
            <x-select-input aria-label="estatu" wire:model.live="estatu" :options="$estatus" :selected="'TODOS'"/>
        </div>

    </div>

    <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-2">

        <x-cards.crearServicioProv :url="route('proveedor.servicios.create')" nombre="Servicio" />

        @foreach ($servicios as $servicio)
            <x-cards.servicioProv :servicio="$servicio" />
        @endforeach


    </div>

</div>
