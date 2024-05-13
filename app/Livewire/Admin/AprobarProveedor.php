<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Servicio;

class AprobarProveedor extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $proveedor = User::role('Proveedor')->find($this->id);
        if ($proveedor) {
            $servicios = Servicio::where('proveedor_id', $proveedor->id)->get();
            return view('livewire.admin.aprobar-proveedor', compact('proveedor', 'servicios'));
        }else {
            return "Este proveedor no existe!!!";
        }
    }
}
