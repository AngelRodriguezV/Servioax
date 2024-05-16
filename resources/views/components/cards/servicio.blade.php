@props(['servicio'])
<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
    {{-- Image --}}
    <a href="{{ route('servicio', $servicio) }}">
        <img class="object-cover object-center h-64 rounded-t-lg"
            src="{{ Storage::url($servicio->image ? $servicio->image->url : 'image/Carpinteria.jpg') }}" alt="" />
    </a>
    <div class="p-5">
        {{-- Proveedor --}}
        <div class="flex mb-3">
            @isset($servicio->proveedor->image)
                <img id="picture" src="{{ Storage::url($servicio->proveedor->image->url) }}" alt=""
                    class="w-10 h-10 rounded-full bg-gray-300">
            @else
                <img id="picture"
                    src="https://cdn.icon-icons.com/icons2/602/PNG/512/Gender_Neutral_User_icon-icons.com_55902.png"
                    alt="" class="w-10 h-10 rounded-full bg-gray-300">
            @endisset
            <a href="" class="my-auto ml-4">{{ $servicio->proveedor->nombre . ' ' . $servicio->proveedor->apellido_paterno . ' ' . $servicio->proveedor->apellido_materno }}</a>
        </div>
        {{-- Titulo --}}
        <a href="{{ route('servicio', $servicio) }}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $servicio->nombre }}
            </h5>
        </a>
        {{-- Valoracion --}}
        <div class="flex mb-3">
            <x-rating :rating="$servicio->rating()['valoracion']" />
            <p class="font-bold ml-2 text-lg">{{ $servicio->rating()['rating'] }}</p>
        </div>
        {{-- Descripcion --}}
        <p class="mb-3 font-normal text-gray-700">{{ $servicio->descripcion }}</p>
        {{-- Categoria --}}
        <p class="mb-3 font-normal text-gray-700">Categoria: {{ $servicio->categoria->nombre }}</p>
        {{-- Button --}}
        <a href="{{ route('servicio', $servicio) }}"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            Más información
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a>
    </div>
</div>
