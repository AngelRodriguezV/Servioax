<?php

namespace App\Livewire\Admin;

use App\Models\Servicio;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Servicios extends Component
{
    use WithPagination;

    public $search;
    public $estatu = 'TODOS';
    public $estatus = [
        'TODOS' => 'Todos',
        'NUEVA' => 'Nueva',
        'EN REVISION' => 'En revision',
        'ACEPTADA' => 'Aceptada',
        'RECHAZADA' => 'Rechezada',
        'EN PROCESO' => 'En proceso'
    ];
    public $proveedor;

    public function mount(User $proveedor)
    {
        $this->proveedor = $proveedor;
    }

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
        $myQuery = Servicio::where('proveedor_id', $this->proveedor->id);

        if ($this->search) {
            $myQuery->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                    ->orwhere(function ($query) {
                        $query->whereHas('categoria', function ($query) {
                            $query->where('nombre', 'like', '%' . $this->search . '%');
                        });
                    });
            });
        }

        if ($this->estatu != 'TODOS') {
            $myQuery->where('estatus', $this->estatu);
        }

        $servicios = $myQuery->paginate(10);
        return view('livewire.admin.servicios', compact('servicios'));
    }
}
