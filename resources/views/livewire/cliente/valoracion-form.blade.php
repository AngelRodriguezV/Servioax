<div class="my-4 p-2 border-2 rounded-lg border-gray-200">
    <h2 class="p-2 font-bold">Agrega una valoración</h2>
    <form wire:submit="save">
        @csrf
        <div class="flex items-center">
            @for ($i = 0; $i < $rating; $i++)
                <button type="button" wire:click="setRating({{ $i + 1 }})" class="w-10 h-10 mx-2"
                    {{ $solicitud->estatus == 'COMPLETADA' ? '' : 'disabled' }}>
                    <svg class="w-10 h-10 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                </button>
            @endfor

            @for ($i = $rating; $i < 5; $i++)
                <button type="button" wire:click="setRating({{ $i + 1 }})" class="w-10 h-10 mx-2"
                    {{ $solicitud->estatus == 'COMPLETADA' ? '' : 'disabled' }}>
                    <svg class="w-10 h-10 ms-1 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                </button>
            @endfor
        </div>

        <label for="message" class="block text-sm font-medium text-gray-900 p-2">Mi valoración</label>
        <textarea id="message" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Agrega una valoracion al servicio solicitado" required wire:model="comentario"
            {{ $solicitud->estatus == 'COMPLETADA' ? '' : 'disabled' }}>{{ $comentario }}</textarea>
        @if ($solicitud->estatus == 'COMPLETADA')

        <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-2 focus:outline-none">Guardar</button>
        @endif
        <p>{{ $mensaje }}</p>
    </form>
</div>
