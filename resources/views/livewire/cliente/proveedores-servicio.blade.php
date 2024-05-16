<div>
    <div class="mx-auto max-w-7xl px-2 py-6">
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
        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-2 mt-6">
            @foreach ($servicios as $servicio)
                <x-cards.servicio :servicio="$servicio" />
            @endforeach

            <div class="mx-4 my-2 col-span-full">
                {{-- $servicios->links() --}}
            </div>
        </div>

    </div>
</div>
