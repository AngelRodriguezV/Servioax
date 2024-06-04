<?php

namespace App\Livewire\Proveedor;

use App\Models\DiasTrabajo;
use App\Models\Horario;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Scheduler2 extends Component
{
    public $semanas = [
        '1' => 'Lunes',
        '2' => 'Martes',
        '3' => 'Miercoles',
        '4' => 'Jueves',
        '5' => 'Viernes',
        '6' => 'Sabado',
        '7' => 'Domingo'
    ];

    public $diasDisponibles;
    public $horasDisponibles;

    public function mount()
    {
        $this->diasDisponibles = DiasTrabajo::where('proveedor_id', Auth::user()->id)->get();
        $this->horasDisponibles = Horario::whereIn('dia_trabajo_id', DiasTrabajo::select('id')->where('proveedor_id', Auth::user()->id)->get())->get();
    }

    public function crear_dia($variable)
    {
        switch ($variable) {
            case 'Lunes':
                DiasTrabajo::create([
                    'N' => 1,
                    'dia_semana' => 'Lunes',
                    'proveedor_id' => Auth::user()->id,
                ]);
                break;
            case 'Martes':
                DiasTrabajo::create([
                    'N' => 2,
                    'dia_semana' => 'Martes',
                    'proveedor_id' => Auth::user()->id,
                ]);
                break;
            case 'Miercoles':
                DiasTrabajo::create([
                    'N' => 3,
                    'dia_semana' => 'Miercoles',
                    'proveedor_id' => Auth::user()->id,
                ]);
                break;
            case 'Jueves':
                DiasTrabajo::create([
                    'N' => 4,
                    'dia_semana' => 'Jueves',
                    'proveedor_id' => Auth::user()->id,
                ]);
                break;
            case 'Viernes':
                DiasTrabajo::create([
                    'N' => 5,
                    'dia_semana' => 'Viernes',
                    'proveedor_id' => Auth::user()->id,
                ]);
                break;
            case 'Sabado':
                DiasTrabajo::create([
                    'N' => 6,
                    'dia_semana' => 'Sabado',
                    'proveedor_id' => Auth::user()->id,
                ]);
                break;
            case 'Domingo':
                DiasTrabajo::create([
                    'N' => 7,
                    'dia_semana' => 'Domingo',
                    'proveedor_id' => Auth::user()->id,
                ]);
                break;
            default:
                # code...
                break;
        }
    }

    public function eliminar_dia($variable)
    {
        $dia = DiasTrabajo::where('proveedor_id', Auth::user()->id)->where('dia_semana', $variable)->get()->first();
        if ($dia) {
            $dia->delete();
        }
    }

    public function crear_hora($variable)
    {
        $data = explode('-',$variable);
        $dia = DiasTrabajo::where('proveedor_id', Auth::user()->id)->where('dia_semana', $data[0])->get()->first();
        if ($dia) {
            Horario::create([
                'hora_apertura' => $data[1],
                'hora_cierre' => $data[2],
                'dia_trabajo_id' => $dia->id,
            ]);
        }
    }

    public function eliminar_hora($variable)
    {
        $data = explode('-',$variable);
        $dia = DiasTrabajo::where('proveedor_id', Auth::user()->id)->where('dia_semana', $data[0])->get()->first();
        if ($dia) {
            $hora = Horario::where('dia_trabajo_id', $dia->id)->where('hora_apertura', $data[1])->where('hora_cierre', $data[2])->get()->first();
            if ($hora) {
                $hora->delete();
            }
        }
    }


    public function render()
    {
        $this->diasDisponibles = DiasTrabajo::where('proveedor_id', Auth::user()->id)->get();
        $this->horasDisponibles = Horario::whereIn('dia_trabajo_id', DiasTrabajo::select('id')->where('proveedor_id', Auth::user()->id)->get())->get();
        return view('livewire.proveedor.scheduler2');
    }
}
