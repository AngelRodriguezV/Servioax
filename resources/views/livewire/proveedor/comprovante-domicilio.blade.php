<x-form-section submit="updatePhoto">
    <x-slot name="title">
        Comprovante de Domicilio
    </x-slot>

    <x-slot name="description">
        Actualiza tu comprovante de domicilio
    </x-slot>

    <x-slot name="form">
        <div class="flex items-center justify-center w-full col-span-6 sm:col-span-4">
            <label
                class="overflow-hidden flex flex-col items-center justify-center border-2 border-bone-200 cursor-pointer bg-white hover:bg-bone-300 text-bone-300 hover:text-white w-full h-96">
                @isset($photo)
                    <img id="domicilio" src="{{ $photo->temporaryUrl() }}" alt="" class="w-full h-full">
                @else
                    <img id="domicilio" src="{{ Storage::url($img_defaut) }}" alt=""
                        class="object-cover object-center w-full">
                @endisset
                <input id="domicilio" name="domicilio" type="file" accept="image/*" class="hidden"
                    wire:model="photo" />
            </label>

            <script>
                document.getElementById("domicilio").addEventListener('change', cambiarImagen);

                function cambiarImagen(event) {
                    var file = event.target.files[0];
                    var reader = new FileReader();
                    reader.onload = (event) => {
                        document.getElementById("domicilio").setAttribute('src', event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            </script>

        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>
        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
