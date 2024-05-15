<x-prov-layout>

    <div class="mx-auto max-w-7xl px-2 py-6">
        <h1 class="font-bold text-xl text-center">
            ¡Bienvenido {{ Auth::user()->nombre . ' ' . Auth::user()->apellido_paterno . ' ' . Auth::user()->apellido_materno }}!
        </h1>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <a href="{{ route('proveedor.servicios.index') }}" class="p-6 font-bold bg-gray-50 rounded-xl shadow-md border-2 hover:border-blue-500 hover:bg-gray-100">
                Mis servicios
                <p class="font-normal mt-5">Administre sus servicios</p>
            </a>
            <a href="{{ route('proveedor.direcciones') }}" class="p-6 font-bold bg-gray-50 rounded-xl shadow-md border-2 hover:border-blue-500 hover:bg-gray-100">
                Direcciones
                <p class="font-normal mt-5">Administre sus direcciones</p>
            </a>
            <a href="{{ route('proveedor.perfil') }}" class="p-6 font-bold bg-gray-50 rounded-xl shadow-md border-2 hover:border-blue-500 hover:bg-gray-100">
                Administrar perfil
                <p class="font-normal mt-5">Edita tus datos personales</p>
            </a>
            <a href="{{ route('proveedor.horarios') }}" class="p-6 font-bold bg-gray-50 rounded-xl shadow-md border-2 hover:border-blue-500 hover:bg-gray-100">
                Horarios
                <p class="font-normal mt-5">Gestiones y establesca sus horarios</p>
            </a>
        </div>
    </div>

</x-prov-layout>
