<div class="w-full">

    <div class="bg-white w-full border-t rounded-lg shadow-xl mb-4 p-4">
        <h2 class="text-2xl ">
            Datos del usuario
        </h2>
    </div>

    <div class="bg-white w-full border-t rounded-lg shadow-xl mb-4 p-4">
        <div class=" p-4 border-b">
            <p class="text-sm text-gray-500">
                Detalles de datos personales.
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Nombre completo
            </p>
            <p>
                {{ $proveedor->nombre . ' ' . $proveedor->apellido_paterno . ' ' . $proveedor->apellido_materno }}
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Correo Electronico
            </p>
            <p>
                {{ $proveedor->email }}
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Telefono
            </p>
            <p>
                {{ $proveedor->telefono }}
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Fecha de registro
            </p>
            <p>
                {{ $proveedor->created_at->format('d M Y') }}
            </p>
        </div>
        {{-- Foto de perfil --}}
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Foto de perfil
            </p>
            <div class="flex-shrink-0 w-32 h-32">
                @isset($proveedor->image)
                    <img id="picture" src="{{ Storage::url($proveedor->image->url) }}" alt=""
                        class="w-32 h-32 rounded-full bg-gray-300">
                @else
                    <p>Sin foto de perfil</p>
                @endisset
            </div>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Estado de verificación
            </p>
            <p>
                <x-button-status :value="$proveedor->documento->estatus" />
            </p>
        </div>
    </div>
    {{-- Direccion --}}
    <div class="bg-white w-full border-t rounded-lg shadow-xl mb-4 p-4">
        <div class=" p-4 border-b">
            <p class="text-sm text-gray-500">
                Detalles de dirección
            </p>
        </div>
        @if ($proveedor->documento->direccion)
            {{-- Calle --}}
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Calle
                </p>
                <p>
                    {{ $proveedor->documento->direccion->calle }}
                </p>
            </div>
            {{-- Numero exterior --}}
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Numero exterior
                </p>
                <p>
                    {{ $proveedor->documento->direccion->num_exterior }}
                </p>
            </div>
            {{-- Numero interior --}}
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Numero Interior
                </p>
                <p>
                    {{ $proveedor->documento->direccion->num_interior }}
                </p>
            </div>
            {{-- Colonia --}}
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Colonia
                </p>
                <p>
                    {{ $proveedor->documento->direccion->colonia }}
                </p>
            </div>
            {{-- Municipio --}}
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Municipio
                </p>
                <p>
                    {{ $proveedor->documento->direccion->municipio }}
                </p>
            </div>
            {{-- Estado --}}
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Estado
                </p>
                <p>
                    {{ $proveedor->documento->direccion->estado }}
                </p>
            </div>
            {{-- Codigo Postal --}}
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Codigo Postal
                </p>
                <p>
                    {{ $proveedor->documento->direccion->codigo_postal }}
                </p>
            </div>
            {{-- Referencias --}}
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Referencias
                </p>
                <p>
                    {{ $proveedor->documento->direccion->referencias }}
                </p>
            </div>
        @else
            <div>
                Aun no ha registrado su dirección
            </div>
        @endif
    </div>
    {{-- Comprobante de domicilio --}}
    <div class="bg-white w-full border-t rounded-lg shadow-xl mb-4 p-4">
        <div class=" p-4 border-b">
            <p class="text-sm text-gray-500">
                Comprobante de domicilio
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4">
            <p class="text-gray-600">
                Comprobante de domicilio
            </p>
            <div>
                @if ($proveedor->documento->url_domicilio != null)
                    <img src="{{ Storage::url($proveedor->documento->url_domicilio) }}" alt=""
                        class="w-96 h-48 rounded-lg">
                @else
                    <p>Aun no sube su comprobante de domicilio</p>
                @endif
            </div>
        </div>
    </div>
    {{-- INE --}}
    <div class="bg-white w-full border-t rounded-lg shadow-xl mb-4 p-4">
        <div class=" p-4 border-b">
            <p class="text-sm text-gray-500">
                INE
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4">
            <p class="text-gray-600">
                Credencial de identificación
            </p>
            <div>
                @if ($proveedor->documento->url_ine != null)
                    <img src="{{ Storage::url($proveedor->documento->url_ine) }}" alt=""
                        class="w-96 h-48 rounded-lg">
                @else
                    <p>Aun no sube su identificación</p>
                @endif
            </div>
        </div>
    </div>
    {{-- Horarios --}}
    <div class="bg-white w-full border-t rounded-lg shadow-xl mb-4 p-4">
        <div class=" p-4 border-b">
            <p class="text-sm text-gray-500">
                Horarios
            </p>
        </div>
        @forelse ($proveedor->horarios as $horario)
            <div class="grid md:grid-cols-3 hover:bg-gray-50 md:space-y-0 space-y-1 p-4">
                <p class="text-gray-600">
                    {{ $horario->dia_semana }}
                </p>
                <p class="text-gray-600">
                    {{ $horario->hora_apertura }}
                </p>
                <p class="text-gray-600">
                    {{ $horario->hora_cierre }}
                </p>
            </div>
        @empty
        @endforelse

    </div>
    {{-- Acciones --}}
    <div class="bg-white w-full border-t rounded-lg shadow-xl mb-4 p-4">
        <div class=" p-4 border-b">
            <p class="text-sm text-gray-500">
                Cambiar el estatus del proveedor
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Estado de verificación
            </p>
            <p>
                <x-button-status :value="$proveedor->documento->estatus" />
            </p>
        </div>
        <div class="grid lg:flex gap-2 mt-2">
            <div class="relative">
                <label for="estatus"
                    class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">Estatus:</label>
                <x-select-input aria-label="estatu" wire:model.live="estatu" :options="$estatus" />
            </div>
            <div>
                <x-button type="button" wire:click="actualizarEstado()">Guardar</x-button>
            </div>
            <div>
                <x-action-message class="me-3" on="saved">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
            <div>
                <a href="{{ route('admin.mensajes', $proveedor) }}"
                    class="rounded-lg items-center px-4 py-3 absolute text-white bg-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" class="w-4 h-5" viewBox="0 0 24 24">
                        <path
                            d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM9 11H7V9h2v2zm4 0h-2V9h2v2zm4 0h-2V9h2v2z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
