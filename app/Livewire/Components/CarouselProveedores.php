<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;

class CarouselProveedores extends Component
{
    public function render()
    {
        $proveedores = User::whereHas('roles', function ($query) {
            $query->where('name', 'Proveedor');
        })
        ->whereHas('documento', function ($query) {
            $query->where('estatus', 'ACEPTADA');
        })
        ->latest('updated_at')->get();

        return view('livewire.components.carousel-proveedores', compact('proveedores'));
    }
}
