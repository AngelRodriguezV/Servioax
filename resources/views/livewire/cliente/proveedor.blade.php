<div>
    <p class="font-bold text-xl" id="reseñas">
        Los servicio que ofrece
    </p>
    <div class="p-4">
        <div class="p-4">
            <div class="grid md:grid-cols-2">
                <div>
                    <x-search wire:model.live="search" />
                </div>
                <div>
                    Calificacion
                    <div class="ml-4 mt-4 grid grid-cols-3 md:grid-cols-5 gap-4">
                        <button type="button" wire:click="setRating(5)">
                            <x-rating />
                        </button>
                        <button type="button" wire:click="setRating(4)">
                            <x-rating :rating="4" />
                        </button>
                        <button type="button" wire:click="setRating(3)">
                            <x-rating :rating="3" />
                        </button>
                        <button type="button" wire:click="setRating(2)">
                            <x-rating :rating="2" />
                        </button>
                        <button type="button" wire:click="setRating(1)">
                            <x-rating :rating="1" />
                        </button>
                    </div>
                </div>
            </div>
            <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-2 mt-4">
                @forelse ($servicios as $servicio)
                    <x-cards.servicio :servicio="$servicio" />
                @empty
                <p>No se encontraron servicios disponibles</p>
                @endforelse
            </div>
        </div>
    </div>

</div>
