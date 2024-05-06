<?php

namespace App\Livewire\Cliente;

use App\Models\Servicio;
use App\Models\Solicitud;
use Livewire\WithPagination;
use Livewire\Component;

class Solicitudes extends Component
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
        'EN PROCESO' => 'En proceso',
        'COMPLETADA' => 'Completada',
        'CANCELADA' => 'Cancelada'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $query = Solicitud::where('cliente_id', auth()->user()->id);

        if ($this->search) {
            $ids = Servicio::select('id')->where('nombre', 'like', '%' . $this->search . '%')->get();
            $query->whereIn('servicio_id', $ids);
        }

        if ($this->estatu != 'TODOS') {
            $query->where('estatus', $this->estatu);
        }

        $solicitudes = $query->latest('updated_at')->get();
        return view('livewire.cliente.solicitudes', compact('solicitudes'));
    }
}
