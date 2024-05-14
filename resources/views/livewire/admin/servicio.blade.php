<div>
    {{-- Servicio --}}
    <div class="bg-white w-full border-t rounded-lg shadow-xl mb-4 p-4">
        <div class=" p-4 border-b">
            <p class="text-sm text-gray-500">
                Detalles del servicio
            </p>
        </div>
        {{-- Nombre --}}
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Nombre
            </p>
            <p>
                {{ $servicio->nombre }}
            </p>
        </div>
        {{-- Descripcion --}}
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Descripción
            </p>
            <p>
                {{ $servicio->descripcion }}
            </p>
        </div>
        {{-- Categoria --}}
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Categoria
            </p>
            <p>
                {{ $servicio->categoria->nombre }}
            </p>
        </div>
        {{-- Categoria descripcion --}}
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Categoria descripción
            </p>
            <p>
                {{ $servicio->categoria->descripcion }}
            </p>
        </div>
        {{-- Estatus --}}
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Estatus del servicio
            </p>
            <p>
                <x-button-status :value="$servicio->estatus" />
            </p>
        </div>
        {{-- Imagen --}}
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Estatus del servicio
            </p>
            <div>
                @isset($servicio->image)
                    <img src="{{ Storage::url($servicio->image->url) }}" alt="" class="w-96 h-48 rounded-lg">
                @else
                    <p>Aun no sube una foto del servicio</p>
                @endisset
            </div>
        </div>
    </div>
    {{-- Acciones --}}
    <div class="bg-white w-full border-t rounded-lg shadow-xl mb-4 p-4">
        <div class=" p-4 border-b">
            <p class="text-sm text-gray-500">
                Cambiar el estatus del servicio
            </p>
        </div>
        <div class="grid lg:flex gap-2 mt-2">
            @if (in_array($servicio->proveedor->documento->estatus, ['ACEPTADA', 'EN REVISION']))
                <div class="relative">
                    <label for="estatus"
                        class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">Estatus:</label>
                    <x-select-input aria-label="estatu" wire:model.live="estatu" :options="$estatus" />
                </div>
                <div>
                    <x-button type="button" wire:click="actualizarEstado()">
                        Guardar
                    </x-button>
                </div>
                <div>
                    <x-action-message class="me-3" on="saved">
                        {{ __('Saved.') }}
                    </x-action-message>
                </div>
            @else
                <p>El proveedor de servicio aun no es aceptado</p>
            @endif
        </div>
    </div>
</div>
