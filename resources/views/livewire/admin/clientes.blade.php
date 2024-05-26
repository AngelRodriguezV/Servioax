<div>
    <div class="grid lg:flex gap-2">
        <x-search wire:model.live="search" />
    </div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden bg-white">
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
                            Estatus
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Mensaje
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
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
                                            {{ $cliente->nombre . ' ' . $cliente->apellido_paterno . ' ' . $cliente->apellido_materno }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $cliente->email }}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $cliente->telefono }}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <x-button-status href="{{ route('admin.aprobarCuentas', $cliente) }}" :value="$cliente->documento->estatus"/>
                            </td>
                            <td class="mt-0">
                                <a href="{{ route('admin.mensajes', $cliente) }}"
                                    class="rounded-lg items-center px-4 py-3 block text-white bg-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" class="w-4 h-5 mx-auto" viewBox="0 0 24 24">
                                        <path
                                            d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM9 11H7V9h2v2zm4 0h-2V9h2v2zm4 0h-2V9h2v2z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mx-4 my-2">
                {{ $clientes->links() }}
            </div>
        </div>
    </div>
</div>
