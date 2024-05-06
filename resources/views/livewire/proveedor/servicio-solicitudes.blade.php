<div>

    <div class="grid lg:flex gap-2 my-2">
        <div class="relative">
            <label for="estatus" class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">Estatus:</label>
            <x-select-input aria-label="estatu" wire:model.live="estatu" :options="$estatus" :selected="'TODOS'"/>
        </div>

    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-white rounded-full border-b-4 border-slate-200">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cliente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estatus
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha Registro
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha Solicitada
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Hora Solicitada
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudes as $solicitud)
                <tr class="bg-white">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $solicitud->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $solicitud->cliente->nombre }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $solicitud->estatus }}
                        <x-button class="mt-2">Editar</x-button>
                    </td>
                    <td class="px-6 py-4">
                        {{ $solicitud->created_at->format('Y-m-d') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $solicitud->fecha }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $solicitud->hora }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
