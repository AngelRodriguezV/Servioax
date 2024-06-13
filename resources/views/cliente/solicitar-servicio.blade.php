<x-guest-layout>

    <div class="w-4/5 mx-auto py-6">

        <h1 class="my-4 font-bold text-2xl">
            Calendario de horas disponibles - {{ $servicio->nombre }}
        </h1>

        <form method="GET" action="{{ route('cliente.solicitud.show') }}" class="grid">
            <input type="text" name="servicio_id" value="{{$servicio->id}}" aria-label="servicio" hidden>

            @livewire('cliente.scheduler', ['proveedor' => $servicio->proveedor])

        </form>
    </div>
</x-guest-layout>
