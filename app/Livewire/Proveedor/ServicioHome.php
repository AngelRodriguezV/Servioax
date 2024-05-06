<?php

namespace App\Livewire\Proveedor;

use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class ServicioHome extends Component
{
    use WithPagination;

    public $search;
    public $estatu = 'TODOS';
    public $estatus = [
        'TODOS' => 'Todos',
        'NUEVA' => 'Nueva solicitud',
        'EN REVISION' => 'En revision',
        'ACEPTADA' => 'Aceptada',
        'RECHAZADA' => 'Rechezada',
        'EN PROCESO' => 'En proceso'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Servicio::where('proveedor_id', Auth::user()->id);

        if ($this->search) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        }

        if ($this->estatu != 'TODOS') {
            $query->where('estatus', $this->estatu);
        }

        $servicios = $query->latest('updated_at')->get();

        return view('livewire.proveedor.servicio-home', compact('servicios'));
    }
}
