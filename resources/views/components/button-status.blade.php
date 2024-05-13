@props(['value'])
@php
    switch ($value) {
        case 'NUEVA':
            $classes = 'bg-blue-500';
            break;
        case 'EN REVISION':
            $classes = 'bg-orange-500';
            break;
        case 'ACEPTADA':
            $classes = 'bg-green-500';
            break;
        case 'RECHAZADA':
            $classes = 'bg-red-500';
            break;
        default:
            $classes = 'bg-gray-500';
            break;
    }
@endphp
<a {{ $attributes }} class="rounded-lg px-3 py-2 text-white font-bold {{ $classes }}">
    {{ $value }}
</a>
