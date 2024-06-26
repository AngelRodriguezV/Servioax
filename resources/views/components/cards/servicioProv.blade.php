@props(['servicio'])
<div class="max-w-sm bg-white border border-gray-300 rounded-lg shadow-xl">
    <a href="#">
        <img class="object-cover object-center h-40 w-full rounded-t-lg" src="{{ Storage::url($servicio->image ? $servicio->image->url : 'image/Carpinteria.jpg') }}" alt="" />
    </a>
    <div class="p-5">
        <a href="{{route('proveedor.servicios.show', $servicio)}}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$servicio->nombre}}</h5>
        </a>
        <x-button-status :value="$servicio->estatus"/>
        <p class="my-3 font-normal text-gray-700">{{ $servicio->descripcion }}</p>
        <a href="{{route('proveedor.servicios.show', $servicio)}}" class="inline-flex items-center px-3 py-2 bottom-0 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            Ver publicación
             <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
    </div>
</div>
