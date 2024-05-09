<?php

namespace App\Livewire\Cliente;

use App\Models\Servicio;
use App\Models\User;
use App\Models\Valoracion;
use Livewire\Component;

class ProveedorComentarios extends Component
{
    public $proveedor;

    public function mount(User $proveedor)
    {
        $this->proveedor = $proveedor;
    }

    public function render()
    {

        $servicios = Servicio::select('id')
            ->where('proveedor_id', $this->proveedor->id)
            ->where('estatus', 'ACEPTADA')->get();

        $valoraciones = Valoracion::whereIn('servicio_id', $servicios)
            ->latest('valoracion')
            ->paginate(10);

        return view('livewire.cliente.proveedor-comentarios', compact('valoraciones'));
    }
}
