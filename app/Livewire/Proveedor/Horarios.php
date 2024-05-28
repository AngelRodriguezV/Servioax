<?php

namespace App\Livewire\Proveedor;

use App\Models\DiasTrabajo;
use App\Models\Horario;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Horarios extends Component
{
    public $do_state = [
        'dia_semana' => 'Domingo',
        'N' => 7
    ];
    public $lu_state = [
        'dia_semana' => 'Lunes',
        'N' => 1
    ];
    public $ma_state = [
        'dia_semana' => 'Martes',
        'N' => 2
    ];
    public $mi_state = [
        'dia_semana' => 'Miercoles',
        'N' => 3
    ];
    public $ju_state = [
        'dia_semana' => 'Jueves',
        'N' => 4
    ];
    public $vi_state = [
        'dia_semana' => 'Viernes',
        'N' => 5
    ];
    public $sa_state = [
        'dia_semana' => 'Sabado',
        'N' => 6
    ];

    public $new_time = [];
    public $edit_time = [];

    public function mount()
    {
        $this->actualizar();
    }

    public function actualizar()
    {
        $dias = DiasTrabajo::where('proveedor_id', Auth::user()->id)->get();
        foreach ($dias as $dia) {
            switch ($dia->dia_semana) {
                case 'Domingo':
                    $this->do_state = $dia->withoutRelations()->toArray();
                    break;
                case 'Lunes':
                    $this->lu_state = $dia->withoutRelations()->toArray();
                    break;
                case 'Martes':
                    $this->ma_state = $dia->withoutRelations()->toArray();
                    break;
                case 'Miercoles':
                    $this->mi_state = $dia->withoutRelations()->toArray();
                    break;
                case 'Jueves':
                    $this->ju_state = $dia->withoutRelations()->toArray();
                    break;
                case 'Viernes':
                    $this->vi_state = $dia->withoutRelations()->toArray();
                    break;
                case 'Sabado':
                    $this->sa_state = $dia->withoutRelations()->toArray();
                    break;
                default:
                    # code...
                    break;
            }
        }
    }

    public function save($semana)
    {
        switch ($semana) {
            case 'Domingo':
                DiasTrabajo::create(array_merge($this->do_state, ['proveedor_id' => Auth::user()->id]));
                break;
            case 'Lunes':
                DiasTrabajo::create(array_merge($this->lu_state, ['proveedor_id' => Auth::user()->id]));
                break;
            case 'Martes':
                DiasTrabajo::create(array_merge($this->ma_state, ['proveedor_id' => Auth::user()->id]));
                break;
            case 'Miercoles':
                DiasTrabajo::create(array_merge($this->mi_state, ['proveedor_id' => Auth::user()->id]));
                break;
            case 'Jueves':
                DiasTrabajo::create(array_merge($this->ju_state, ['proveedor_id' => Auth::user()->id]));
                break;
            case 'Viernes':
                DiasTrabajo::create(array_merge($this->vi_state, ['proveedor_id' => Auth::user()->id]));
                break;
            case 'Sabado':
                DiasTrabajo::create(array_merge($this->sa_state, ['proveedor_id' => Auth::user()->id]));
                break;
            default:
                # code...
                break;
        }
        /*
        $dia = DiasTrabajo::where('proveedor_id', Auth::user()->id)
            ->where('dia_semana', $semana)->first();
        if ($dia) {
            switch ($dia) {
                case 'Domingo':
                    $dia->update($this->do_state);
                    break;
                case 'Lunes':
                    $dia->update($this->lu_state);
                    break;
                case 'Martes':
                    $dia->update($this->ma_state);
                    break;
                case 'Miercoles':
                    $dia->update($this->mi_state);
                    break;
                case 'Jueves':
                    $dia->update($this->ju_state);
                    break;
                case 'Viernes':
                    $dia->update($this->vi_state);
                    break;
                case 'Sabado':
                    $dia->update($this->sa_state);
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
        }*/
        $this->actualizar();
    }

    public function delete($semana)
    {
        $dia = DiasTrabajo::where('proveedor_id', Auth::user()->id)
            ->where('dia_semana', $semana)->first();
        if ($dia) {
            $dia->delete();
            switch ($semana) {
                case 'Domingo':
                    $this->do_state = [
                        'dia_semana' => 'Domingo',
                        'N' => 7
                    ];
                    break;
                case 'Lunes':
                    $this->lu_state = [
                        'dia_semana' => 'Lunes',
                        'N' => 1
                    ];
                    break;
                case 'Martes':
                    $this->ma_state = [
                        'dia_semana' => 'Martes',
                        'N' => 2
                    ];
                    break;
                case 'Miercoles':
                    $this->mi_state = [
                        'dia_semana' => 'Miercoles',
                        'N' => 3
                    ];
                    break;
                case 'Jueves':
                    $this->ju_state = [
                        'dia_semana' => 'Jueves',
                        'N' => 4
                    ];
                    break;
                case 'Viernes':
                    $this->vi_state = [
                        'dia_semana' => 'Viernes',
                        'N' => 5
                    ];
                    break;
                case 'Sabado':
                    $this->sa_state = [
                        'dia_semana' => 'Sabado',
                        'N' => 6
                    ];
                    break;
                default:
                    # code...
                    break;
            }
        }
        $this->actualizar();
    }

    public function saveTime()
    {
        /*$this->validate([
            'new_time.dia_trabajo_id' => 'required',
            'new_time.hora_apertura' => 'required|date_format:H:i',
            'new_time.hora_cierre' => 'required|date_format:H:i|after:new_time.hora_apertura',
        ]);*/
        $old_times = Horario::where('dia_trabajo_id', $this->new_time['dia_trabajo_id'])->get();
        $valido = true;

        foreach ($old_times as $time) {
            if (
                ($this->new_time['hora_apertura'] <= $time->hora_cierre && $this->new_time['hora_apertura'] >= $time->hora_apertura)
                || ($this->new_time['hora_cierre'] <= $time->hora_cierre && $this->new_time['hora_cierre'] >= $time->hora_apertura)
                || ($time->hora_apertura <= $this->new_time['hora_cierre'] && $time->hora_apertura >= $this->new_time['hora_apertura'])
                || ($time->hora_cierre <= $this->new_time['hora_cierre'] && $time->hora_cierre >= $this->new_time['hora_apertura'])
            ) {
                $valido = false;
                break;
            }
        }
        if ($valido) {
            Horario::create($this->new_time);
            $this->new_time = [];
            session()->flash('message', 'Horario creado con éxito.');
        } else {
            session()->flash('error', 'El horario se solapa con un horario existente.');
        }
    }

    public function deleteHorario($id)
    {
        $horario = Horario::find($id);
        if ($horario) {
            $horario->delete();
        }
    }

    public function updateHorario($id)
    {
        $old_times = Horario::where('dia_trabajo_id', $this->edit_time[$id]['dia_trabajo_id'])->distinct('id', $id)->get();
        $valido = true;

        foreach ($old_times as $time) {
            if (
                ($this->edit_time[$id]['hora_apertura'] <= $time->hora_cierre && $this->edit_time[$id]['hora_apertura'] >= $time->hora_apertura)
                || ($this->edit_time[$id]['hora_cierre'] <= $time->hora_cierre && $this->edit_time[$id]['hora_cierre'] >= $time->hora_apertura)
                || ($time->hora_apertura <= $this->edit_time[$id]['hora_cierre'] && $time->hora_apertura >= $this->edit_time[$id]['hora_apertura'])
                || ($time->hora_cierre <= $this->edit_time[$id]['hora_cierre'] && $time->hora_cierre >= $this->edit_time[$id]['hora_apertura'])
            ) {
                $valido = false;
                break;
            }
        }
        if ($valido) {
            $horario = Horario::find($id);
            if ($horario) {
                $horario->update($this->edit_time[$id]);
                session()->flash('message', 'Horario actualizo con éxito.');
            }
        } else {
            session()->flash('error', 'El horario se solapa con un horario existente.');
        }
    }

    public function render()
    {
        $dias = DiasTrabajo::where('proveedor_id', Auth::user()->id)->pluck('dia_semana', 'id');
        $dias2 = DiasTrabajo::select('id')->where('proveedor_id', Auth::user()->id)->get();
        $horarios = Horario::whereIn('dia_trabajo_id', $dias2)->get();
        foreach ($horarios as $horario) {
            $this->edit_time[$horario->id] = [
                'dia_trabajo_id' => $horario->dia_trabajo_id,
                'hora_apertura' => $horario->hora_apertura,
                'hora_cierre' => $horario->hora_cierre,
            ];
        }

        $this->new_time['dia_trabajo_id'] = $dias->keys()->first();

        return view('livewire.proveedor.horarios', compact('dias', 'horarios'));
    }
}
