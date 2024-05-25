<div class="mx-auto max-w-7xl px-2 py-6">
    <div class="py-4 font-bold text-2xl">Categorias</div>
    <div class="grid md:grid-cols-2">
        <x-search wire:model.live="search" />
    </div>
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-2 mt-6">
        @foreach ($categorias as $categoria)
            <x-cards.categoria :categoria="$categoria" />
        @endforeach

        <div class="mx-4 my-2 col-span-full">
            {{ $categorias->links() }}
        </div>
    </div>
</div>
