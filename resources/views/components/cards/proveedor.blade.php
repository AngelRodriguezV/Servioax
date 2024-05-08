@props(['proveedor'])
<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
    {{-- Image --}}
    <div class="p-5">
        <div class="mb-3 w-[300px] h-[300px]">
            @isset($proveedor->image)
                <img id="picture" src="{{ Storage::url($proveedor->image->url) }}" alt=""
                    class="w-full rounded-full bg-gray-300">
            @else
                <img id="picture"
                    src="https://cdn.icon-icons.com/icons2/602/PNG/512/Gender_Neutral_User_icon-icons.com_55902.png"
                    alt="" class="w-full rounded-full bg-gray-300 mx-auto">
            @endisset
        </div>
        {{-- Titulo --}}
        <a href="">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 text-center">
                {{ $proveedor->nombre }}
            </h5>
        </a>
        {{-- Valoracion --}}
        <div class="flex mb-3">
            <x-rating :rating="$proveedor->rating()['valoracion']" />
            <p class="font-bold ml-2 text-lg">{{ $proveedor->rating()['rating'] }}</p>
        </div>
        <div class="mb-3">
            <h6 class="font-bold mb-2">Top Servicios</h6>
            @forelse ($proveedor->topServicios() as $servicio)
                <a href="{{ route('servicio', $servicio) }}" class="flex group">
                    <x-icons.circle class="w-4 h-4" />
                    <p class="ml-2">
                        {{ $servicio->nombre }}
                    </p>
                </a>
            @empty
            @endforelse
        </div>
        {{-- Button --}}
        <a href=""
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
