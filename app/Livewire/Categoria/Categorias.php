<?php

namespace App\Livewire\Categoria;

use App\Models\Categoria;
use Livewire\Component;

class Categorias extends Component
{
    public function render()
    {
        $categorias = Categoria::all();
        return view('livewire.categoria.categorias', compact('categorias'));
    }
}
