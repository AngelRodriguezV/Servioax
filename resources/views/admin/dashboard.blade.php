<x-admin-layout>
    <div class="mx-auto max-w-7xl px-2 py-6">
        <h1 class="font-bold text-xl text-center">
            ¡Bienvenido Administrador!
        </h1>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <a href="{{ route('admin.adminProv') }}" class="p-6 font-bold bg-gray-50 rounded-xl shadow-md border-2 hover:border-blue-500 hover:bg-gray-100">
                Proveedores de servicios
                <p class="font-normal mt-5">Administra y aprueba proveedores de servicio</p>
            </a>
            <a href="{{ route('admin.adminClie') }}" class="p-6 font-bold bg-gray-50 rounded-xl shadow-md border-2 hover:border-blue-500 hover:bg-gray-100">
                Clientes
                <p class="font-normal mt-5">Administra los clientes</p>
            </a>
            <a href="{{ route('admin.perfil') }}" class="p-6 font-bold bg-gray-50 rounded-xl shadow-md border-2 hover:border-blue-500 hover:bg-gray-100">
                Administrar perfil
                <p class="font-normal mt-5">Edita tus datos personales</p>
            </a>
            <a href="{{ route('admin.gestionCategorias') }}" class="p-6 font-bold bg-gray-50 rounded-xl shadow-md border-2 hover:border-blue-500 hover:bg-gray-100">
                Gestione las categorias de servicios
                <p class="font-normal mt-5">Cree, modifique o elimine una categoria de servicio</p>
            </a>
        </div>
    </div>
</x-admin-layout>