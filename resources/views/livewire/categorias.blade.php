<div class="mx-auto max-w-7xl px-2 py-6">
    <div class="py-4 font-bold text-2xl">Categoria {{$categoria->nombre}}</div>
    <div class="grid md:grid-cols-2">
        <div>
            <x-search wire:model.live="search" />
            <x-button id="getLocationBtn" class="bg-blue-600 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline-block">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                Filtrar por más cercanos
            </x-button>
            <p class="hidden" id="location"></p>
        </div>
        <div>
            Calificacion
            <div class="ml-4 mt-4 grid grid-cols-3 md:grid-cols-5 gap-4">
                <button type="button" wire:click="setRating(5)">
                    <x-rating />
                </button>
                <button type="button" wire:click="setRating(4)">
                    <x-rating :rating="4" />
                </button>
                <button type="button" wire:click="setRating(3)">
                    <x-rating :rating="3" />
                </button>
                <button type="button" wire:click="setRating(2)">
                    <x-rating :rating="2" />
                </button>
                <button type="button" wire:click="setRating(1)">
                    <x-rating :rating="1" />
                </button>
            </div>
        </div>
    </div>
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-2 mt-6">
        @foreach ($servicios as $servicio)
            <x-cards.servicio :servicio="$servicio" />
        @endforeach
    </div>
</div>

<script>
    document.getElementById('getLocationBtn').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            document.getElementById('location').innerText = "La geolocalización no es compatible con este navegador.";
        }
    });

    function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        document.getElementById('location').innerText = "Latitud: " + latitude + " , Longitud: " + longitude;
        @this.set('latitude', latitude);
        @this.set('longitude', longitude);
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                document.getElementById('location').innerText = "Usuario denegó la solicitud de geolocalización."
                break;
            case error.POSITION_UNAVAILABLE:
                document.getElementById('location').innerText = "La información de ubicación no está disponible."
                break;
            case error.TIMEOUT:
                document.getElementById('location').innerText = "La solicitud para obtener la ubicación del usuario ha expirado."
                break;
            case error.UNKNOWN_ERROR:
                document.getElementById('location').innerText = "Se ha producido un error desconocido."
                break;
        }
    }
</script>
