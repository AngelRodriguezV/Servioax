<x-guest-layout>

    <div class="py-6 mx-auto max-w-7xl px-2">

        <div class="grid md:grid-cols-2">

            <div class="mb-3 w-[250px] h-[250px] mx-auto">
                @isset($proveedor->image)
                    <img id="picture" src="{{ Storage::url($proveedor->image->url) }}" alt=""
                        class="w-full rounded-full bg-gray-300">
                @else
                    <img id="picture"
                        src="https://cdn.icon-icons.com/icons2/602/PNG/512/Gender_Neutral_User_icon-icons.com_55902.png"
                        alt="" class="w-full rounded-full bg-gray-300">
                @endisset
            </div>
            <div class="my-auto">

                <h1>{{ $proveedor->nombre . ' ' . $proveedor->apellido_paterno . ' ' . $proveedor->apellido_materno }}
                </h1>
                <div class="flex mt-2">
                    <p class="font-bold mr-2 my-auto">{{ $proveedor->rating()['valoracion'] }}</p>
                    <x-rating :rating="$proveedor->rating()['valoracion']" />
                    <a href="#reseñas" class="pl-4 my-auto text-blue-500">
                        {{ $proveedor->rating()['rating'] }} Calificaciones
                    </a>
                </div>
            </div>

        </div>

        @livewire('cliente.proveedor', ['proveedor' => $proveedor])

        @livewire('cliente.proveedor-comentarios', ['proveedor' => $proveedor])

    </div>

</x-guest-layout>
