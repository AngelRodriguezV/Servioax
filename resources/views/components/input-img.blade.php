@props(['size' => 'cuadro', 'url' => null])

@php
    switch ($size) {
        case 'cuadro':
            $classes = 'w-80 h-80 md:w-96 md:h-96 rounded-full';
            $img_defaut = 'svg/upload.svg';
            break;
        case 'horizontal':
            $classes = 'w-full h-40 md:h-56 lg:h-96';
            $img_defaut = 'svg/upload-lg-horizontal.svg';
            break;
        default:
            $classes = 'w-96 h-96 rounded-lg';
            $img_defaut = 'svg/upload.svg';
            break;
    }
@endphp

<div class="flex items-center justify-center w-full">
    <label
        class="overflow-hidden flex flex-col items-center justify-center border-2 border-bone-200 cursor-pointer bg-white hover:bg-bone-300 text-bone-300 hover:text-white {{ $classes }}">
        @isset($url)
            <img id="picture" src="{{ Storage::url($url) }}" alt="" class="object-cover object-center w-full">
        @else
            <img id="picture" src="{{ Storage::url($img_defaut) }}" alt="" class="object-cover object-center w-full">
        @endisset
        <input id="file" name="file" type="file" accept="image/*" class="hidden" />
    </label>

    <script>
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }
    </script>

</div>