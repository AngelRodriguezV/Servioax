@php
    use Carbon\Carbon;
@endphp

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-400">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="{{ route('proveedor.dashboard') }}" class="flex ms-2 md:me-24">
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">ServiMex</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            @isset(Auth::user()->image)
                                <img src="{{ Storage::url(Auth::user()->image->url) }}" alt=""
                                    class="w-8 h-8 rounded-full bg-gray-300">
                            @else
                                <img src="https://cdn.icon-icons.com/icons2/602/PNG/512/Gender_Neutral_User_icon-icons.com_55902.png" alt=""
                                    class="w-8 h-8 rounded-full bg-gray-300">
                            @endisset
                        </button>
                    </div>
                        

<button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:text-gray-400" type="button">
    <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
    <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z"/>
    </svg>
    @if (auth()->user()->unreadNotifications->isNotEmpty())
        <div class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 dark:border-gray-900"></div>
    @endif
    <!--<div class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 dark:border-gray-900"></div>-->
    </button>
    
    <!-- Dropdown menu -->
    <div id="dropdownNotification" class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-300 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
      <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-300 dark:text-black">
          Notificaciones
      </div>
      <div class="divide-y divide-gray-100 dark:divide-gray-700">
        @if (!auth()->user()->unreadNotifications->isNotEmpty())
            <div class="flex-shrink-0">
                </div>
                <div class="w-full ps-3 text-center">
                    <span class="font-semibold text-gray-900 dark:text-blue-800">Sin notificaciones nuevas</span>
                </div>
        @endif
        @foreach (auth()->user()->unreadNotifications as $notification)
            <div  class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-400">
                <a href="{{ route('proveedor.markAsReadId', ['id' => $notification->id]) }}">
                    <svg class="h-8 w-8 text-gray-800 hover:text-blue-600 transition duration-300 ease-in-out transform hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>                    
                </a>
                <a href="{{ route('proveedor.aprobar', ['solicitud' => $notification->data['solicitud']]) }}">
                                        
                
                
                <div class="w-full ps-3">
                    <div class="text-gray-500 text-sm mb-1.5 dark:text-black">El cliente <span class="font-semibold text-gray-900 dark:text-blue-800">{{ $notification->data['cliente_nombre']. ' ' .$notification->data['cliente_apellidoP']. ' ' .$notification->data['cliente_apellidoM'] }}</span> 
                        solicitó el servicio <span class="font-semibold text-gray-900 dark:text-blue-800">{{ $notification->data['servicio_nombre'] }}</span> con un horario de <span class="font-semibold text-gray-900 dark:text-blue-800">{{ Carbon::parse($notification->data['hora_inicio'])->format('g:i A') }}</span>
                        a <span class="font-semibold text-gray-900 dark:text-blue-800">{{ Carbon::parse($notification->data['hora_termino'])->format('g:i A') }}</span>
                    </div>
                    <div class="font-semibold text-xs text-blue-600 dark:text-blue-800">{{ $notification->created_at->diffForHumans() }}</div>
                </div>
                </a>
            </div>
        @endforeach
      </div>
      @if (auth()->user()->unreadNotifications->isNotEmpty())
        <a href="{{ route('proveedor.markAsRead') }}" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-300 dark:hover:bg-gray-400 dark:text-black">
            <div class="inline-flex items-center ">
                <svg class="h-8 w-8 text-gray-800 hover:text-blue-600 transition duration-300 ease-in-out transform hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>  
                Marcar todo como leído
            </div>
        </a>
         @endif
      
      <a href="{{ route('proveedor.notificacionP') }}" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-300 dark:hover:bg-gray-400 dark:text-black">
        <div class="inline-flex items-center ">
          <svg class="w-6 h-6 me-2 text-gray-500 dark:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
            <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
          </svg>
            Ver todas las notificaciones
        </div>
      </a>
    </div>
    
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-2xl border-2 border-gray-200"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900" role="none">
                                {{Auth::user()->nombre}}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                {{Auth::user()->email}}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a  href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Sign out</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
