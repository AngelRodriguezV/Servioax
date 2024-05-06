<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Servicio;
use Livewire\WithPagination;
use Livewire\Component;

class Categorias extends Component
{
    use WithPagination;

    public $search;

    public $rating = 0;

    public $categoria;

    public function mount($categoria)
    {
        $this->categoria = $categoria;
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
        $query = Servicio::where('categoria_id', $this->categoria->id)->where('estatus', 'ACEPTADA');

        if ($this->search) {
            $query->where('nombre', 'like', '%' . $this->search . '%')->get();
        }

        $aux = $query->get();

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

        return view('livewire.categorias', compact('servicios'));
    }
}
