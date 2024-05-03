<div class="grid gap-4 mt-4">
    <div class="grid lg:flex gap-2">
        <x-search wire:model.live="search" />
        <div class="relative">
            <label for="estatus" class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">Estatus:</label>
            <x-select-input aria-label="estatu" wire:model.live="estatu" :options="$estatus" :selected="'TODOS'"/>
        </div>

    </div>
    @forelse ($solicitudes as $solicitud)
        <a href="{{ route('cliente.solicitud', $solicitud) }}" class="p-2 px-4 w-full bg-gray-50 rounded-xl shadow-md border-2 hover:border-blue-500">
            <p class="py-2">
                {{ $solicitud->created_at->format('d/M/Y') }}
            </p>
            <div class="flex gap-4">
                <div>
                    <img class="rounded-lg object-cover object-center w-40"
                        src="{{ Storage::url($solicitud->servicio->image ? $solicitud->servicio->image->url : 'image/Carpinteria.jpg') }}"
                        alt="" />
                </div>
                <div>
                    <p class="font-bold mt-2">
                        Servicio: <span class="font-normal">{{ $solicitud->servicio->nombre }}</span>
                    </p>
                    <p class="font-bold mt-2">
                        Proveedor: <span class="font-normal">{{ $solicitud->servicio->proveedor->nombre }}</span>
                    </p>
                    <p class="mt-2 rounded-lg p-2 w-32 bg-gray-300 text-center">
                        {{ $solicitud->estatus }}
                    </p>
                    {{$solicitud->id}}
                </div>
            </div>
        </a>

    @empty
    <p>No se encontraron resultados</p>
    @endforelse
</div>
