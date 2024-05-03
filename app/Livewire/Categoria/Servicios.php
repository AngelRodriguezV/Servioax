<?php

namespace App\Livewire\Categoria;

use Livewire\Component;
use App\Models\Servicio;

class Servicios extends Component
{
    public function render()
    {
        $servicios = Servicio::all();
        return view('livewire.categoria.servicios', compact('servicios'));
    }
}
