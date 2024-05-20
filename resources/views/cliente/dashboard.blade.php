<x-cliente-layout>

    <div class="mx-auto max-w-7xl px-2 py-6">
        <h1 class="font-bold text-xl">
            Mi cuenta
        </h1>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <a href="{{ route('cliente.solicitudes') }}" class="p-6 font-bold bg-white rounded-xl shadow-md border-2 hover:border-blue-500 hover:bg-gray-100">
                Mis Solicitudes
                <p class="font-normal mt-5">Revisa las solicitudes de servicio solicitadas</p>
            </a>
            <a href="{{ route('cliente.direcciones') }}" class="p-6 font-bold bg-white rounded-xl shadow-md border-2 hover:border-blue-500 hover:bg-gray-100">
                Direcciones
                <p class="font-normal mt-5">Edita tus direcciones para la solicitud de los servicios</p>
            </a>
            <a href="{{ route('cliente.perfil') }}" class="p-6 font-bold bg-white rounded-xl shadow-md border-2 hover:border-blue-500 hover:bg-gray-100">
                Administrar Perfil
                <p class="font-normal mt-5">Edita tus datos personales</p>
            </a>
        </div>
    </div>

</x-cliente-layout>
