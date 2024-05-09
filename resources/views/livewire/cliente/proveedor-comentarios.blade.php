<div>
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
        <div class="mt-4">
            {{ $valoraciones->links() }}
        </div>
    </div>
</div>
