<div>

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
            <ul class="space-y-2 font-medium">

                @foreach ($conversaciones as $conversacion)
                    <li>
                        <button type="button" wire:click="setConversacion({{ $conversacion }})"
                            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-blue-800 hover:text-white group w-full">
                            <img src="" alt=""
                                class="w-10 h-10 bg-blue-700 rounded-full object-cover object-center">
                            @foreach ($conversacion->users as $user)
                                @if (auth()->user()->id != $user->id)
                                    <span class="flex-1 ms-3 whitespace-nowrap">{{ $user->nombre }}</span>
                                @endif
                            @endforeach
                            <span
                                class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64 h-screen">
        <div class="p-4 h-full border-2 border-gray-200 border-dashed rounded-lg content-end">

            @if ($conversacion_actual)


                <div class="grid my-4 px-2 gap-3 overflow-hidden overflow-y-scroll h-[89%]">

                    @foreach ($conversacion_actual->mensajes as $sms)
                        @if ($sms->remitente->id == auth()->user()->id)

                            <div class="grid gap-1">
                                <div class="place-self-end p-2 px-4 rounded-lg border-blue-600 border-2">
                                    {{ $sms->mensaje }}
                                </div>
                                <div class="text-stone-400 text-xs text-end my-2 pl-4">
                                    {{ $sms->created_at }}
                                </div>
                            </div>
                        @else
                            <div class="grid gap-1">
                                <div class="place-self-start p-2 px-4 rounded-lg border-blue-600 border-2">
                                    {{ $sms->mensaje }}
                                </div>
                                <div class="text-stone-400 text-xs text-start my-2 pb-4">
                                    {{ $sms->created_at }}
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

                <form class="align-bottom" wire:submit="save_mensaje">
                    @csrf
                    <label for="chat" class="sr-only">Your message</label>
                    <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50">
                        <textarea id="chat" rows="1"
                            class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Your message..." wire:model="mensaje"></textarea>
                        <button type="submit"
                            class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                            <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path
                                    d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                            </svg>
                            <span class="sr-only">Send message</span>
                        </button>
                    </div>
                </form>
            @endif

        </div>
    </div>

</div>
