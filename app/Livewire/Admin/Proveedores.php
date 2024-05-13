<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Proveedores extends Component
{
    use WithPagination;

    public $search;
    public $estatu = 'TODOS';
    public $estatus = [
        'TODOS' => 'Todos',
        'NUEVA' => 'Nueva',
        'EN REVISION' => 'En revision',
        'ACEPTADA' => 'Aceptada',
        'RECHAZADA' => 'Rechezada'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingEstatu()
    {
        $this->resetPage();
    }

    public function render()
    {
        #Mi mejor query
        $myQuery = User::whereHas('roles', function($query) {
            $query->where('name', 'Proveedor');
        });

        if ($this->search) {
            $myQuery->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('apellido_paterno', 'like', '%' . $this->search . '%')
                    ->orWhere('apellido_materno', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->estatu != 'TODOS') {
            $myQuery->whereHas('documento', function($query) {
                $query->where('estatus', $this->estatu);
            });
        }

        $proveedors = $myQuery->paginate(10);

        return view('livewire.admin.proveedores', compact('proveedors'));
    }
}
