<?php

namespace App\Livewire\Categoria;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class Categorias extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Categoria::select('*');

        if ($this->search) {
            $query->where('nombre', 'like', '%' . $this->search . '%')->get();
        }

        $categorias = $query->get();
        return view('livewire.categoria.categorias', compact('categorias'));
    }
}
