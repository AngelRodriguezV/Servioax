<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class BusquedaProv extends Component
{
    public $search;
    use WithPagination;

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {

        $query = User::role('Proveedor');

        if ($this->search) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        }

        $proveedors = $query->get();
        #$proveedors = User::role('Proveedor')->get();
        return view('livewire.busqueda-prov', compact('proveedors'));
    }
}
