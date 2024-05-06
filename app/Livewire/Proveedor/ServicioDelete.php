<?php

namespace App\Livewire\Proveedor;

use App\Models\Servicio;
use Livewire\Component;

class ServicioDelete extends Component
{

    public $confirmingDelete = false;
    public $servicio;

    public function mount(Servicio $servicio)
    {
        $this->servicio = $servicio;
    }

    public function confirmDelete()
    {
        $this->confirmingDelete = true;
    }

    public function deleteServicio()
    {
        $this->servicio->delete();
        return redirect()->route('proveedor.servicios.index');
    }

    public function render()
    {
        return view('livewire.proveedor.servicio-delete');
    }
}
