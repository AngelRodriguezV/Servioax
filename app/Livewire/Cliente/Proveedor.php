<?php

namespace App\Livewire\Cliente;

use App\Models\Servicio;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Proveedor extends Component
{
    use WithPagination;

    public $search;

    public $rating = 0;

    public $proveedor;

    public function mount(User $proveedor)
    {
        $this->proveedor = $proveedor;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setRating($rating)
    {
        if ($this->rating != 0) {
            if ($this->rating == $rating) {
                $this->rating = 0;
            } else {
                $this->rating = $rating;
            }
        } else {
            $this->rating = $rating;
        }
    }

    public function render()
    {

        $query = Servicio::where('proveedor_id', $this->proveedor->id)->where('estatus', 'ACEPTADA');

        if ($this->search) {
            $query->where('nombre', 'like', '%' . $this->search . '%')->get();
        }

        $aux = $query->paginate(8);

        $servicios = collect([]);

        if ($this->rating != 0) {
            foreach ($aux as $servicio) {
                if ($servicio->rating()['valoracion'] == $this->rating) {
                    $servicios->push($servicio);
                }
            }
        } else {
            $servicios = $aux;
        }
        return view('livewire.cliente.proveedor', compact('servicios'));
    }
}
