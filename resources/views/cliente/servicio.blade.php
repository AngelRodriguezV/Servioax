<x-guest-layout>

    <div class="py-6 mx-auto max-w-7xl px-2">
        <div>

            <img class="h-72 w-full object-cover object-center rounded-lg"
                src="{{ Storage::url($servicio->image ? $servicio->image->url : 'image/Carpinteria.jpg') }}"
                alt="image description">

            <h1 class="text-2xl font-bold mt-2">{{ $servicio->nombre }}</h1>

            <div class="grid grid-cols-2">

                <div class="flex mt-3">
                    <p class="font-bold mr-2 my-auto">{{ $servicio->rating()['valoracion'] }}</p>
                    <x-rating :rating="$servicio->rating()['valoracion']" />
                    <a href="#reseñas" class="pl-4 my-auto text-blue-500">
                        {{ $servicio->rating()['rating'] }} Calificaciones
                    </a>
                </div>

                <div class="flex mt-3">
                    <img class="w-10 h-10 rounded-full bg-gray-300"
                        src="https://cdn.icon-icons.com/icons2/602/PNG/512/Gender_Neutral_User_icon-icons.com_55902.png"
                        alt="Rounded avatar">
                    <a href="" class="my-auto ml-4">{{ $servicio->proveedor->name }}</a>
                </div>
            </div>

            <p class="mt-3">{{ $servicio->descripcion }}</p>

        </div>

        {{-- Recomendaciones --}}
        <div class="mt-6">
            <p class="text-xl font-bold">Mas servicios del proveedor {{ $servicio->proveedor->name }}</p>
            <x-carousel.servicios :servicios="$sv_pros" />
            <p class="text-xl font-bold">Servicios similares</p>
            <x-carousel.servicios :servicios="$servicio->proveedor->servicios" />
        </div>

        {{-- Opiniones y Reseñas --}}
        <div class="grid lg:grid-cols-3">
            {{-- Opiniones de los clientes --}}
            <div class="my-2">
                <p class="font-bold text-xl mb-2" id="reseñas">
                    Opiniones de los clientes
                </p>
                <x-rating :rating="$servicio->rating()['valoracion']" :size="6" />
                @for ($i = 5; $i > 0; $i--)
                    <div class="flex items-center mt-4 pl-4">
                        <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            {{ $i }} estrellas
                        </a>
                        <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                            <div class="h-5 bg-yellow-300 rounded" style="width: 70%"></div>
                        </div>
                    </div>
                @endfor
            </div>
            {{-- Reseñas de los clientes --}}
            <div class="lg:col-span-2 grid gap-2 my-2">
                <p class="font-bold text-xl" id="reseñas">
                    Reseñas de los clientes
                </p>
                @foreach ($valoraciones as $reseña)
                    <div class="border border-gray-200 rounded-lg shadow px-4 py-2">
                        <div class="flex mt-3">
                            <img class="w-10 h-10 rounded-full bg-gray-300"
                                src="https://cdn.icon-icons.com/icons2/602/PNG/512/Gender_Neutral_User_icon-icons.com_55902.png"
                                alt="Rounded avatar">
                            <a href="" class="my-auto ml-4">{{ $reseña->user->name }}</a>
                        </div>
                        <div class="flex my-3">
                            <x-rating :rating="$reseña->valoracion" />
                        </div>
                        {{ $reseña->comentario }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>



</x-guest-layout>
