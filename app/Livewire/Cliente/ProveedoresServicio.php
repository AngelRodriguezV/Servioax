<?php

namespace App\Livewire\Cliente;

use App\Models\Servicio;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Component;

class ProveedoresServicio extends Component
{
    use WithPagination;

    public $search;

    public $rating = 0;

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
            ->where('estatus', 'ACEPTADA');

        if ($this->search) {
            $queryServicios->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                    ->orWhere(function ($query) {
                        $query->whereHas('categoria', function ($query) {
                            $query->where('nombre', 'like', '%' . $this->search . '%')
                                ->orWhere('descripcion', 'like', '%' . $this->search . '%');
                        });
                    })
                    ->orWhere(function ($query) {
                        $query->whereHas('proveedor', function ($query) {
                            $query->where(DB::raw("CONCAT(nombre,' ',apellido_paterno,' ',apellido_materno)"), 'like', '%' . $this->search . '%');
                        });
                    });
            });
        }

        $servicios = $queryServicios->get(); #paginate(12);

        if ($this->rating != 0) {
                $servicios = $servicios->filter(function ($servicio) {
                return $servicio->rating()['valoracion'] === $this->rating;
            });
        }

        return view('livewire.cliente.proveedores-servicio', compact('servicios'));
    }
}
