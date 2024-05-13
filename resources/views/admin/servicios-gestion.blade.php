<x-admin-layout>
<div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-2">
    @foreach ($servicios as $servicio)
        <x-cards.servicioAdmin :servicio="$servicio"/>
    @endforeach
</div>
</x-admin-layout>