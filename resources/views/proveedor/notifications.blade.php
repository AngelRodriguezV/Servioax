@php
    use Carbon\Carbon;
@endphp

<x-prov-layout>

    <div class="mx-auto max-w-7xl px-2 py-6">
        <h1 class="font-bold text-xl text-center">
            Todas las notificaciones
        </h1>
<div class="max-w-4xl mx-auto">
	<div class="p-4 max-w-4xl bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-300 dark:border-gray-700">
   <div class="flow-root">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach (auth()->user()->notifications as $notification)
            <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-black">
                            El cliente <span class="font-semibold text-gray-900 dark:text-blue-800">{{ $notification->data['cliente_nombre']. ' ' .$notification->data['cliente_apellidoP']. ' ' .$notification->data['cliente_apellidoM'] }}</span>
                            solicitó el servicio <span class="font-semibold text-gray-900 dark:text-blue-800">{{ $notification->data['servicio_nombre'] }}</span>
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-black">
                            con un horario de <span class="font-semibold text-gray-900 dark:text-blue-800">{{ Carbon::parse($notification->data['hora_inicio'])->format('g:i A') }}</span>
                            a <span class="font-semibold text-gray-900 dark:text-blue-800">{{ Carbon::parse($notification->data['hora_termino'])->format('g:i A') }}</span>
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-black">
                            Solicitud hecha <span class="font-semibold text-gray-900 dark:text-blue-800">{{ $notification->created_at->diffForHumans() }}</span>
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-black">
                        <a href="{{ route('proveedor.aprobar', ['solicitud' => $notification->data['solicitud']]) }}" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-400">
                            Ver Solicitud
                        </a>
                        <a href="{{ route('proveedor.deleteNotification', ['id' => $notification->id]) }}" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                              </svg>                              
                            Borrar
                        </a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
   </div>
</div>

</x-prov-layout>
