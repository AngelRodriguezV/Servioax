<x-login-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form action="{{ route('set-direccion') }}" method="POST" class="grid grid-cols-2 gap-6">
            @csrf
            {{-- Codigo postal --}}
            <div>
                <x-label for="codigo_postal" value="Codigo Postal" />
                <x-input id="codigo_postal" type="text" name="codigo_postal" class="mt-1 block w-full"
                    required />
                <x-input-error for="codigo_postal" class="mt-2" />
            </div>
            <div>
                <x-label for="colonia" value="Colonia" />
                <x-input name="colonia" id="colonia" type="text" class="mt-1 block w-full"
                    required />
                    <x-input-error for="colonia" class="mt-2" />
            </div>
            <div>
                <x-label for="estado" value="Estado" />
                <x-input id="estado" type="text" class="mt-1 block w-full" name="estado"
                    required />
                <x-input-error for="estado" class="mt-2" />
            </div>
            <div>
                <x-label for="municipio" value="Municipio" />
                <x-input id="municipio" type="text" class="mt-1 block w-full" name="municipio"
                    required />
                <x-input-error for="municipio" class="mt-2" />
            </div>
            <div>
                <x-label for="calle" value="Calle" />
                <x-input id="calle" type="text" class="mt-1 block w-full" name="calle" required />
                <x-input-error for="calle" class="mt-2" />
            </div>
            <div>
                <x-label for="num_exterior" value="Numero exterior" />
                <x-input id="num_exterior" type="text" class="mt-1 block w-full" name="num_exterior"
                    required />
                <x-input-error for="num_exterior" class="mt-2" />
            </div>
            <div>
                <x-label for="num_interior" value="Numero interior" />
                <x-input id="num_interior" type="text" class="mt-1 block w-full" name="num_interior" />
                <x-input-error for="num_interior" class="mt-2" />
            </div>
            <div>
                <x-label for="entre_calle1" value="Entre calle" />
                <x-input id="entre_calle1" type="text" class="mt-1 block w-full" name="entre_calle1" />
                <x-input-error for="entre_calle1" class="mt-2" />
            </div>
            <div>
                <x-label for="entre_calle2" value="Entre calle" />
                <x-input id="entre_calle2" type="text" class="mt-1 block w-full" name="entre_calle2" />
                <x-input-error for="entre_calle2" class="mt-2" />
            </div>
            <div>
                <x-label for="referencias" value="Referencias" />
                <x-input id="referencias" type="text" class="mt-1 block w-full" name="referencias"
                    required />
                <x-input-error for="referencias" class="mt-2" />
            </div>
            <div class="hidden">
                <x-label for="latitud" value="Latitud" />
                <x-input id="latitud" type="text" class="mt-1 block w-full" name="latitud" />
                <x-input-error for="latitud" class="mt-2" />
            </div>
            <div class="hidden">
                <x-label for="longitud" value="Longitud" />
                <x-input id="longitud" type="text" class="mt-1 block w-full" name="longitud" />
                <x-input-error for="longitud" class="mt-2" />
            </div>
            <x-button type="submit" class="my-4">Guardar</x-button>
        </form>

    </x-authentication-card>
</x-login-layout>
