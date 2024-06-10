<div class="grid gap-2">
    <div class="grid lg:flex gap-2">
        <x-search wire:model.live="search" />
        <div class="relative">
            <label for="estatus" class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">Estatus:</label>
            <x-select-input aria-label="estatu" wire:model.live="estatu" :options="$estatus" :selected="'TODOS'"/>
        </div>

    </div>
    @foreach ($solicitudes as $solicitud)
        <div class="bg-white p-3 mr-4 rounded-xl shadow-lg grid lg:grid-cols-2 gap-2">
            <p>
                Fecha: {{ $solicitud->fecha}}
            </p>
            <p>
                Estatus de la solicitud: <x-button-status href="{{ route('proveedor.aprobar', $solicitud) }}" :value="$solicitud->estatus" />
            </p>
            <p>
                Servicio: {{ $solicitud->servicio->nombre }}
            </p>
            <p>
                Cliente: {{ $solicitud->cliente->nombre . ' ' . $solicitud->cliente->apellido_paterno . ' ' . $solicitud->cliente->apellido_materno}}
            </p>
            <p>
                Hora de inicio: {{ $solicitud->hora_inicio }}
            </p>
            <p>
                Hora de termino: {{ $solicitud->hora_termino }}
            </p>
            <p>
                <a href="{{ route('proveedor.aprobar', $solicitud) }}" class="text-blue-400">Mas información</a>
            </p>
        </div>
    @endforeach
    <div class="mx-4 my-2 col-span-full">
        {{ $solicitudes->links() }}
    </div>
</div>
