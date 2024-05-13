<div>
    <div class="grid lg:flex gap-2">
        <x-search wire:model.live="search" />
        <div class="relative">
            <label for="estatus" class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">Estatus:</label>
            <x-select-input aria-label="estatu" wire:model.live="estatu" :options="$estatus" :selected="'TODOS'"/>
        </div>
    </div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Correo electronico
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Telefono
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Estado
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Estado Servicios
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedors as $proveedor)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        @isset($servicio->proveedor->image)
                                            <img id="picture"
                                                src="{{ Storage::url($servicio->proveedor->image->url) }}"
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
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $proveedor->email }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $proveedor->telefono }}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <x-button-status :value="$proveedor->documento->estatus" />
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href="{{ route('admin.gestionServicios', $proveedor->id) }}">
                                    <span
                                        class="relative inline-block px-3 py-2 font-semibold text-white leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-indigo-600 rounded-full"></span>
                                        <span class="relative">Ver Servicios</span>
                                    </span>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mx-4 my-2">
                {{ $proveedors->links() }}
            </div>
        </div>
    </div>
</div>
