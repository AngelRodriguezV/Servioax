<?php

namespace App\Livewire\Cliente;

use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class Proveedores extends Component
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
        $proveedores = User::whereHas('roles', function ($query) {
            $query->where('name', 'proveedor');
        })->get();

        $proveedores = $proveedores->filter(function ($user) {
            return $user->documento->estatus === 'ACEPTADA';
        });

        if ($this->rating != 0) {
            $proveedores = $proveedores->filter(function ($user) {
                return $user->rating()['valoracion'] === $this->rating;
            });
        }

        return view('livewire.cliente.proveedores', compact('proveedores'));
    }
}
