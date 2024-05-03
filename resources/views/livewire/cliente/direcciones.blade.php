<div class="grid lg:grid-cols-3 gap-4 mt-4">
    @foreach ($direcciones as $direccion)
    <div class="grid gap-2 p-4 border-2 rounded-lg border-gray-200">
        <div>
            Calle:
            <span>{{$direccion->calle}}</span>
        </div>
        <div>
            Numero exterior:
            <span>{{$direccion->num_exterior}}</span>
        </div>
        <div>
           Numero interior:
            <span>{{$direccion->num_interior}}</span>
        </div>
        <div>
            Colonia:
            <span>{{$direccion->colonia}}</span>
        </div>
        <div>
            Municipio:
            <span>{{$direccion->municipio}}</span>
        </div>
        <div>
            Estado:
            <span>{{$direccion->estado}}</span>
        </div>
        <div>
            Codigo postal:
            <span>{{$direccion->codigo_postal}}</span>
        </div>
        <div>
            Referencias:
            <span>{{$direccion->referencias}}</span>
        </div>
        <div class="grid grid-cols-2 gap-2 text-center mt-2">
            <a href="" class="p-2 bg-green-500 rounded-lg">Editar</a>
            <a href="" class="p-2 bg-red-500 rounded-lg">Eliminar</a>
        </div>
    </div>
    @endforeach
</div>
