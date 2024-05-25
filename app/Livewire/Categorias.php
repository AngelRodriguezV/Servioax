<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        $proveedores = User::select('id')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Proveedor');
            })
            ->whereHas('documento', function ($query) {
                $query->whereIn('estatus', ['ACEPTADA', 'EN REVISION']);
            })
            ->get();

        $queryServicios = Servicio::whereIn('proveedor_id', $proveedores)
            ->whereIn('estatus', ['ACEPTADA', 'EN REVISION'])
            ->where('categoria_id', $this->categoria->id);

        if ($this->search) {
            $queryServicios->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                    ->orWhere(function ($query) {
                        $query->whereHas('proveedor', function ($query) {
                            $query->where(DB::raw("CONCAT(nombre,' ',apellido_paterno,' ',apellido_materno)"), 'like', '%' . $this->search . '%');
                        });
                    });
            });
        }

        $servicios = $queryServicios->get();

        if ($this->rating != 0) {
            $servicios = $servicios->filter(function ($servicio) {
                return $servicio->rating()['valoracion'] === $this->rating;
            });
        }

        return view('livewire.categorias', compact('servicios'));
    }
}
