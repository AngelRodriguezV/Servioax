@props(['servicio', 'url', 'nombre'])
<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="my-auto">
        <a href="{{$url}}">
            <x-icons.add class="text-white w-24 h-24 mx-auto"/>
        </a>
        <div class="p-5">
            <a href="{{$url}}">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Crear un nuevo {{$nombre}}</h5>
            </a>    
        </div>
    </div>
</div>
