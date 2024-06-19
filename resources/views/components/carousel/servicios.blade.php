@props(['servicios'])
<div class="grid grid-cols-1 lg:grid-cols-4 px-16 p-4 gap-2">
    @foreach ($servicios as $servicio)
        <x-cards.servicio :servicio="$servicio" />
    @endforeach
</div>
