<x-admin-layout>
    <div class="p-8 rounded-md w-full">
        <div class="flex items-center justify-between pb-6">
            <div>
                <h2 class="text-gray-600 font-semibold">Proveedor de servicio:</h2>
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-10 h-10">
                        @isset($proveedor->image)
                            <img id="picture"
                                src="{{ Storage::url($proveedor->image->url) }}"
                                alt="" class="w-10 h-10 rounded-full bg-gray-300">
                        @else
                            <img id="picture"
                                src="https://cdn.icon-icons.com/icons2/602/PNG/512/Gender_Neutral_User_icon-icons.com_55902.png"
                                alt="" class="w-10 h-10 rounded-full bg-gray-300">
                        @endisset
                    </div>
                    <div class="ml-3">
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ $proveedor->nombre . ' ' . $proveedor->apellido_paterno . ' ' . $proveedor->apellido_materno }}
                        </p>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="text-gray-600 font-semibold mb-2">Estatus del proveedor:</h2>
                <span>
                    <x-button-status href="{{ route('admin.aprobarCuentas', $proveedor) }}" :value="$proveedor->documento->estatus" />
                </span>
            </div>
        </div>
        @livewire('admin.servicio', ['servicio' => $servicio])
    </div>
</x-admin-layout>
