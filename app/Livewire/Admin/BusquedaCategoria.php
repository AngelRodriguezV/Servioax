<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoria; // No olvides incluir este modelo

class BusquedaCategoria extends Component
{
    public $search;
    use WithPagination;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Categoria::query();

        if ($this->search) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        }

        $categorias = $query->get();

        // Pasar las categorías a la vista
        return view('livewire.admin.busqueda-categoria', compact('categorias'));
    }
}
