<?php

namespace App\Livewire\Proveedor;

use App\Models\Servicio;
use App\Models\Solicitud;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

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
        $servicios = Servicio::select('id')->where('proveedor_id', Auth::user()->id)
            ->whereIn('estatus', ['ACEPTADA', 'EN REVISION']);

        if ($this->search) {
            $servicios->where('nombre', 'like', '%' . $this->search . '%');
        }

        $servicios = $servicios->get();

        $solicitudes = Solicitud::whereIn('servicio_id', $servicios);
        #where('fecha', '>=', now()->format('Y-m-d'))->get();

        if ($this->estatu != 'TODOS') {
            $solicitudes->where('estatus', $this->estatu);
        }

        $solicitudes = $solicitudes->latest('updated_at')->paginate(5);

        return view('livewire.proveedor.solicitudes', compact('solicitudes'));
    }
}
