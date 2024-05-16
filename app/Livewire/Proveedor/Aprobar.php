<?php

namespace App\Livewire\Proveedor;

use Livewire\Component;

class Aprobar extends Component
{
    public $solicitud;
    public $estatu;
    public $estatus = [
        'NUEVA' => 'Nueva',
        'EN REVISION' => 'En revision',
        'ACEPTADA' => 'Aceptada',
        'RECHAZADA' => 'Rechezada',
        'EN PROCESO' => 'En proceso',
        'COMPLETADA' => 'Completada',
        'CANCELADA' => 'Cancelada'
    ];

    public function mount($solicitud)
    {
        $this->solicitud = $solicitud;
        $this->estatu = $this->solicitud->estatus;
    }

    public function actualizarEstado() {
        $this->solicitud->update([
            "estatus" => $this->estatu
        ]);
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.proveedor.aprobar');
    }
}
