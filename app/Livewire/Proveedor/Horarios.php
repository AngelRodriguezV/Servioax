<?php

namespace App\Livewire\Proveedor;

use App\Models\Horario;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Horarios extends Component
{
    public $do_state = ['dia_semana' => 'Domingo'];
    public $lu_state = ['dia_semana' => 'Lunes'];
    public $ma_state = ['dia_semana' => 'Martes'];
    public $mi_state = ['dia_semana' => 'Miercoles'];
    public $ju_state = ['dia_semana' => 'Jueves'];
    public $vi_state = ['dia_semana' => 'Viernes'];
    public $sa_state = ['dia_semana' => 'Sabado'];

    public function mount()
    {
        $this->actualizar();
    }

    public function actualizar()
    {
        $horarios = Horario::where('proveedor_id', Auth::user()->id)->get();
        foreach ($horarios as $horario) {
            switch ($horario->dia_semana) {
                case 'Domingo':
                    $this->do_state = $horario->withoutRelations()->toArray();
                    break;
                case 'Lunes':
                    $this->lu_state = $horario->withoutRelations()->toArray();
                    break;
                case 'Martes':
                    $this->ma_state = $horario->withoutRelations()->toArray();
                    break;
                case 'Miercoles':
                    $this->mi_state = $horario->withoutRelations()->toArray();
                    break;
                case 'Jueves':
                    $this->ju_state = $horario->withoutRelations()->toArray();
                    break;
                case 'Viernes':
                    $this->vi_state = $horario->withoutRelations()->toArray();
                    break;
                case 'Sabado':
                    $this->sa_state = $horario->withoutRelations()->toArray();
                    break;
                default:
                    # code...
                    break;
            }
        }
    }

    public function save($semana)
    {
        $horario = Horario::where('proveedor_id', Auth::user()->id)
            ->where('dia_semana', $semana)->first();
        if ($horario) {
            switch ($semana) {
                case 'Domingo':
                    $horario->update($this->do_state);
                    break;
                case 'Lunes':
                    $horario->update($this->lu_state);
                    break;
                case 'Martes':
                    $horario->update($this->ma_state);
                    break;
                case 'Miercoles':
                    $horario->update($this->mi_state);
                    break;
                case 'Jueves':
                    $horario->update($this->ju_state);
                    break;
                case 'Viernes':
                    $horario->update($this->vi_state);
                    break;
                case 'Sabado':
                    $horario->update($this->sa_state);
                    break;
                default:
                    # code...
                    break;
            }
        } else {
            switch ($semana) {
                case 'Domingo':
                    Horario::create(array_merge($this->do_state, ['proveedor_id' => Auth::user()->id]));
                    break;
                case 'Lunes':
                    Horario::create(array_merge($this->lu_state, ['proveedor_id' => Auth::user()->id]));
                    break;
                case 'Martes':
                    Horario::create(array_merge($this->ma_state, ['proveedor_id' => Auth::user()->id]));
                    break;
                case 'Miercoles':
                    Horario::create(array_merge($this->mi_state, ['proveedor_id' => Auth::user()->id]));
                    break;
                case 'Jueves':
                    Horario::create(array_merge($this->ju_state, ['proveedor_id' => Auth::user()->id]));
                    break;
                case 'Viernes':
                    Horario::create(array_merge($this->vi_state, ['proveedor_id' => Auth::user()->id]));
                    break;
                case 'Sabado':
                    Horario::create(array_merge($this->sa_state, ['proveedor_id' => Auth::user()->id]));
                    break;
                default:
                    # code...
                    break;
            }
        }
        $this->actualizar();
    }

    public function delete($semana)
    {
        $horario = Horario::where('proveedor_id', Auth::user()->id)
            ->where('dia_semana', $semana)->first();
        if ($horario) {
            $horario->delete();
            switch ($semana) {
                case 'Domingo':
                    $this->do_state = ['dia_semana' => 'Domingo'];
                    break;
                case 'Lunes':
                    $this->lu_state = ['dia_semana' => 'Lunes'];
                    break;
                case 'Martes':
                    $this->ma_state = ['dia_semana' => 'Martes'];
                    break;
                case 'Miercoles':
                    $this->mi_state = ['dia_semana' => 'Miercoles'];
                    break;
                case 'Jueves':
                    $this->ju_state = ['dia_semana' => 'Jueves'];
                    break;
                case 'Viernes':
                    $this->vi_state = ['dia_semana' => 'Viernes'];
                    break;
                case 'Sabado':
                    $this->sa_state = ['dia_semana' => 'Sabado'];
                    break;
                default:
                    # code...
                    break;
            }
        }
        $this->actualizar();
    }

    public function render()
    {
        return view('livewire.proveedor.horarios');
    }
}
