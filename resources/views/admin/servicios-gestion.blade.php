<x-admin-layout>
    <div class="bg-white p-8 rounded-md w-full">
        <div class="flex items-center justify-between pb-6">
            <div>
                <h2 class="text-gray-600 font-semibold">Servicios del Proveedores de servicios:</h2>
                <span class="text-xs">{{ $proveedor->nombre . ' ' . $proveedor->apellido_paterno . ' ' . $proveedor->apellido_materno }}</span>
            </div>
            <div>
                <h2 class="text-gray-600 font-semibold">Estatus del proveedor:</h2>
                <span class="text-xs">
                    <x-button-status href="{{ route('admin.aprobarCuentas', $proveedor) }}" :value="$proveedor->documento->estatus"/>
                </span>
            </div>
        </div>
        @livewire('admin.servicios', ['proveedor' => $proveedor])
    </div>
</x-admin-layout>
