<?php

namespace App\Livewire\Cliente;

use App\Models\Direccion;
use Livewire\Component;

class Direcciones extends Component
{
    public function render()
    {
        $direcciones = auth()->user()->direcciones;
        return view('livewire.cliente.direcciones', compact('direcciones'));
    }
}
