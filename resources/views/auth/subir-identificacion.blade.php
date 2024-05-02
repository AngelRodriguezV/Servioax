<x-guest-layout>
    <h1 class="text-center p-5 font-bold text-xl">¡Estas a un paso de convertirte en un proveedor de servicios!</h1>
    <h2 class="text-center mb-4 font-bold text-xl">Sube una identificacion oficial con foto para validar tus datos</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="text-center">
            <x-label for="nombre"></x-label>
            <x-input-img :url="isset($servicio->image) ? $servicio->image->url : null" size=""/>
                <x-button class="mt-4">
                    SUBIR DOCUMENTO
                </x-button>
        </div>
    </form>
</x-guest-layout>