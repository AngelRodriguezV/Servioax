<?php

namespace App\Livewire\Cliente;

use App\Models\Direccion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Direcciones extends Component
{
    public $confirmingDeleteDireccion = false;
    public $confirmingCrearDireccion = false;

    public $direccion_current;

    public $state = [];

    public function confirmCrearDireccion()
    {
        $this->direccion_current = null;
        $this->state = [];
        $this->confirmingCrearDireccion = true;
    }

    public function confirmUpdateDireccion($id)
    {
        $this->direccion_current = Direccion::where('id', $id)->first();
        $this->state = array_merge([], $this->direccion_current->withoutRelations()->toArray());
        $this->confirmingCrearDireccion = true;
    }

    public function confirmDeleteDireccion($id)
    {
        $this->direccion_current = Direccion::where('id', $id)->first();
        $this->confirmingDeleteDireccion = true;
    }

    public function saveDireccion()
    {
        if ($this->direccion_current) {
            $this->direccion_current->update($this->state);
        } else {
            Direccion::create(array_merge($this->state, ['user_id' => Auth::user()->id]));
        }
        $this->confirmingCrearDireccion = false;
    }

    public function deleteDireccion()
    {
        $this->direccion_current->delete();
        $this->direccion_current = null;
        $this->confirmingDeleteDireccion = false;
    }

    public function render()
    {
        $direcciones = Direccion::where('user_id', auth()->user()->id)
            ->latest('updated_at')
            ->get();
        return view('livewire.cliente.direcciones', compact('direcciones'));
    }
}
