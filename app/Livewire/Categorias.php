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
    public $latitude;
    public $longitude;

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
            ->where('estatus', 'ACEPTADA')
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

        if ($this->latitude && $this->longitude) {
            $servicios = $servicios->map(function ($servicio) {
                $distancia = $this->calcularDistancia(
                    $this->latitude,
                    $this->longitude,
                    $servicio->proveedor->direcciones->first()->latitud,
                    $servicio->proveedor->direcciones->first()->longitud
                );
                $servicio->distancia = $distancia;
                return $servicio;
            })->sortBy('distancia');
        }

        return view('livewire.categorias', compact('servicios'));
    }

    private function calcularDistancia($lat1, $lon1, $lat2, $lon2)
    {
        $radioTierra = 6371; // Radio de la Tierra en kilómetros
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distancia = $radioTierra * $c;
        return $distancia;
    }
}
