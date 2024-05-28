<x-guest-layout>

    <div class="py-6 mx-auto max-w-7xl px-2">
        <div>

            <img class="h-72 w-full object-cover object-center rounded-lg"
                src="{{ Storage::url($servicio->image ? $servicio->image->url : 'image/Carpinteria.jpg') }}"
                alt="image description">

            <div class="grid grid-cols-2 mx-4">

                <h1 class="text-2xl font-bold mt-4">{{ $servicio->nombre }}</h1>

                <div class="flex mt-3">
                    <img class="w-10 h-10 rounded-full bg-gray-300"
                        src="https://cdn.icon-icons.com/icons2/602/PNG/512/Gender_Neutral_User_icon-icons.com_55902.png"
                        alt="Rounded avatar">
                    <a href="" class="my-auto ml-4">{{ $servicio->proveedor->nombre . ' ' . $servicio->proveedor->apellido_paterno . ' ' . $servicio->proveedor->apellido_materno }}</a>
                </div>

                <p class="mt-3">{{ $servicio->descripcion }}</p>

                <div class="flex mt-3">
                    <p class="font-bold mr-2 my-auto">{{ $servicio->rating()['valoracion'] }}</p>
                    <x-rating :rating="$servicio->rating()['valoracion']" />
                    <a href="#reseñas" class="pl-4 my-auto text-blue-500">
                        {{ $servicio->rating()['rating'] }} Calificaciones
                    </a>
                </div>

                <div class="mt-2">
                    <p>Horario</p>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <tbody>
                                @forelse ($servicio->proveedor->diasTrabajo as $dia)
                                    <tr class="bg-white border-b">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $dia->dia_semana }}
                                        </th>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @forelse ($dia->horarios as $horario)
                                    <tr class="bg-white border-b">
                                        <th></th>
                                        <td class="px-6 py-4">
                                            {{ $horario->hora_apertura }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $horario->hora_cierre }}
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="mt-4 p-6">
                    <a href="{{ route('cliente.solicitarservicio', $servicio) }}"
                        class="p-2 px-4 bg-blue-700 text-white mx-auto my-2">Solicitar servicio</a>
                </div>
            </div>



        </div>

        {{-- Recomendaciones --}}
        <div class="mt-6 grid gap-2">
            <p class="text-xl font-bold ml-16">Mas servicios del proveedor {{ $servicio->proveedor->name }}</p>
            <x-carousel.servicios :servicios="$sv_pros" />
            <p class="text-xl font-bold ml-16">Servicios similares</p>
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
                @foreach ($rating as $item)
                    <div class="flex items-center mt-4 pl-4">
                        <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            {{ $item['estrellas'] }} estrellas
                        </a>
                        <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                            <div class="h-5 bg-yellow-300 rounded" style="width: {{ $item['porcentaje'] }}%"></div>
                        </div>
                        <span
                            class="text-sm font-medium text-gray-500">{{ sprintf('%01.0f', $item['porcentaje']) }}%</span>
                    </div>
                @endforeach
            </div>
            {{-- Reseñas de los clientes --}}
            <div class="lg:col-span-2 grid gap-2 my-2">
                <p class="font-bold text-xl" id="reseñas">
                    Reseñas de los clientes
                </p>
                @foreach ($valoraciones as $reseña)
                    <div class="border border-gray-200 bg-white rounded-lg shadow px-4 py-2">
                        <div class="flex mt-3">
                            @isset($reseña->user->image)
                                <img id="picture" src="{{ Storage::url($reseña->user->image->url) }}" alt=""
                                    class="w-10 h-10 rounded-full bg-gray-300">
                            @else
                                <img id="picture"
                                    src="https://cdn.icon-icons.com/icons2/602/PNG/512/Gender_Neutral_User_icon-icons.com_55902.png"
                                    alt="" class="w-10 h-10 rounded-full bg-gray-300">
                            @endisset
                            <a href=""
                                class="my-auto ml-4">{{ $reseña->user->nombre . ' ' . $reseña->user->apellido_paterno }}</a>
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
