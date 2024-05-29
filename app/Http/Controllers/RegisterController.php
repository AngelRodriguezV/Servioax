<?php

namespace App\Http\Controllers;

use App\Http\Requests\DireccionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\Conversacion;
use App\Models\Direccion;
use App\Models\Documento;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function register()
    {
        if (Auth::user()->getRoleNames()) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    public function registerUser(UserRequest $request)
    {
        $user = new User();
        $user->nombre = $request->nombre;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        Documento::create([
            'estatus' => 'NUEVA',
            'user_id' => $user->id,
        ]);
        $conversacion = Conversacion::create([
            'estatus' => 'activa'
        ]);
        $conversacion->users()->attach(1);
        $conversacion->users()->attach($user->id);
        return redirect()->route('set-direccion');
    }

    public function tipoUsuario(Request $request)
    {
        if (count(Auth::user()->getRoleNames()) === 0) {
            if ($request->has('tipo_user')) {
                if ($request['tipo_user'] == 'cliente') {
                    Auth::user()->assignRole('Cliente');
                    return redirect()->route('cliente.perfil');
                }
                if ($request['tipo_user'] == 'proveedor') {
                    Auth::user()->assignRole('Proveedor');
                    return redirect()->route('proveedor.perfil');
                }
            }
            return view('auth.asignar-rol');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function setDireccion(Request $request)
    {
        $rules = [
            'calle' => 'required',
            'colonia' => 'required',
            'municipio' => 'estado',
            'num_exterior' => 'required|integer',
            'num_interior' => 'integer',
            'codigo_postal' => 'required|integer',
            'referencias' => 'required'
        ];
        if (Auth::user()->documento->direccion_id === null) {
            if ($request->has('codigo_postal')) {
                $request['user_id'] = Auth::user()->id;
                $direccion = Direccion::create($request->all());
                Auth::user()->documento->update([
                    'direccion_id' => $direccion->id
                ]);
                return redirect()->route('tipo-usuario');
            }
            return view('auth.set-direccion');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function setIne(Request $request)
    {
        if (Auth::user()->documento->url_ine === null) {
            if ($request->file('file')) {
                $url = Storage::disk('public')->put('posts', $request->file('file'));
                Auth::user()->documento->update([
                    'url_ine' => $url
                ]);
                return redirect()->route('dashboard');
            }
            return view('auth.set-ine');
        } else {
            return redirect()->route('dashboard');
        }
    }
}
