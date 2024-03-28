<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Servicio;
use Livewire\Component;

class Categorias extends Component
{

    public $categoria;

    public function mount($categoria)
    {
        $this->categoria = $categoria;
    }

    public function render()
    {
        $servicios = Servicio::where('categoria_id', $this->categoria->id)
            ->get();
        return view('livewire.categorias', compact('servicios'));
    }
}
