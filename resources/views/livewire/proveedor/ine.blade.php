<x-form-section submit="updatePhoto">
    <x-slot name="title">
        INE
    </x-slot>

    <x-slot name="description">
        Actualiza tu INE
    </x-slot>

    <x-slot name="form">
        <div class="flex items-center justify-center w-full col-span-6 sm:col-span-4">
            <label
                class="overflow-hidden flex flex-col items-center justify-center border-2 border-bone-200 cursor-pointer bg-white hover:bg-bone-300 text-bone-300 hover:text-white w-full h-60">
                @isset($photo)
                    <img id="ine" src="{{ $photo->temporaryUrl() }}" alt="" class="object-cover object-center w-full">
                @else
                    <img id="ine" src="{{ Storage::url($img_defaut) }}" alt=""
                        class="object-cover object-center w-full">
                @endisset
                <input id="file" name="file" type="file" accept="image/*" class="hidden"
                    wire:model="photo" />
            </label>

            <script>
                document.getElementById("file").addEventListener('change', cambiarImagen);

                function cambiarImagen(event) {
                    var file = event.target.files[0];
                    var reader = new FileReader();
                    reader.onload = (event) => {
                        document.getElementById("ine").setAttribute('src', event.target.result);
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
