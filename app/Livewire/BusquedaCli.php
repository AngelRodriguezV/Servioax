<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class BusquedaCli extends Component
{

    public $search;
    use WithPagination;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::role('Cliente');

        if ($this->search) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        }

        $clientes = $query->get();
        return view('livewire.busqueda-cli', compact('clientes'));
    }
}
