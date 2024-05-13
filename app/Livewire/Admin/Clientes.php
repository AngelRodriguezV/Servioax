<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $myQuery = User::whereHas('roles', function($query) {
            $query->where('name', 'Cliente');
        });

        if ($this->search) {
            $myQuery->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('apellido_paterno', 'like', '%' . $this->search . '%')
                    ->orWhere('apellido_materno', 'like', '%' . $this->search . '%');
            });
        }

        $clientes = $myQuery->paginate(10);
        return view('livewire.admin.clientes', compact('clientes'));
    }
}
