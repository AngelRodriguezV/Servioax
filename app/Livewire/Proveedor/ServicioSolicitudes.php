<?php

namespace App\Livewire\Proveedor;

use App\Models\Servicio;
use App\Models\Solicitud;
use Livewire\Component;

class ServicioSolicitudes extends Component
{
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

    public $servicio;

    public function mount(Servicio $servicio)
    {
        $this->servicio = $servicio;
    }

    public function render()
    {
        $query = Solicitud::where('servicio_id', $this->servicio->id);

        if ($this->estatu != 'TODOS') {
            $query->where('estatus', $this->estatu);
        }

        $solicitudes = $query
            ->latest('created_at')
            ->get();
        return view('livewire.proveedor.servicio-solicitudes', compact('solicitudes'));
    }
}
