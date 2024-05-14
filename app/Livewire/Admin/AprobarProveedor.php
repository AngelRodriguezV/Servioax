<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Servicio;

class AprobarProveedor extends Component
{
    public $proveedor;
    public $estatu;
    public $estatus = [
        'NUEVA' => 'Nueva',
        'EN REVISION' => 'En revision',
        'ACEPTADA' => 'Aceptada',
        'RECHAZADA' => 'Rechezada'
    ];

    public function mount($id)
    {
        $this->proveedor = User::role('Proveedor')->find($id);
        $this->estatu = $this->proveedor->documento->estatus;
    }

    public function actualizarEstado() {
        $this->proveedor->documento->update([
            "estatus" => $this->estatu
        ]);
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.admin.aprobar-proveedor');
    }
}
