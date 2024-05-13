<x-login-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('tipo-usuario') }}">
            @csrf
            <h3 class="mb-5 text-lg font-medium text-gray-900">Seleccina el tipo de usuario
            </h3>
            <ul class="grid w-full gap-6 md:grid-cols-2">
                <li>
                    <input type="radio" id="hosting-small" name="tipo_user" value="cliente" class="hidden peer"
                        required />
                    <label for="hosting-small"
                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Cliente</div>
                            <div class="w-full">Solicita a un proveedor de servicios</div>
                        </div>
                    </label>
                </li>
                <li>
                    <input type="radio" id="hosting-big" name="tipo_user" value="proveedor" class="hidden peer">
                    <label for="hosting-big"
                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Proveedor</div>
                            <div class="w-full">Conviértete en un proveedor de servicios</div>
                        </div>
                    </label>
                </li>
            </ul>

            <x-button class="mt-4">Guardar</x-button>

        </form>

    </x-authentication-card>
</x-login-layout>
