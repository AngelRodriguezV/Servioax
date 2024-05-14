<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Servicio extends Component
{
    public $servicio;
    public $estatu;
    public $estatus = [
        'NUEVA' => 'Nueva',
        'EN REVISION' => 'En revision',
        'ACEPTADA' => 'Aceptada',
        'RECHAZADA' => 'Rechezada'
    ];

    public function mount($servicio)
    {
        $this->servicio = $servicio;
        $this->estatu = $this->servicio->estatus;
    }

    public function actualizarEstado() {
        $this->servicio->update([
            "estatus" => $this->estatu
        ]);
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.admin.servicio');
    }
}
