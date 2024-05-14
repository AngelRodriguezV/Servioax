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
        $myQuery = Categoria::query();

        if ($this->search) {
            $myQuery->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'like', '%' . $this->search . '%');
            });
        }

        $categorias = $myQuery->paginate(10);

        // Pasar las categorías a la vista
        return view('livewire.admin.busqueda-categoria', compact('categorias'));
    }
}
