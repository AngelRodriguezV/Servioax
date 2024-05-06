@props(['servicio', 'url', 'nombre'])
<div class="max-w-sm bg-white border-gray-300 rounded-lg shadow-xl place-content-center hover:border-green-500 border-2">
    <div class="my-auto">
        <a href="{{$url}}">
            <x-icons.add class="w-24 h-24 mx-auto"/>
        </a>
        <div class="p-5">
            <a href="{{$url}}">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900">Crear un nuevo {{$nombre}}</h5>
            </a>
        </div>
    </div>
</div>
