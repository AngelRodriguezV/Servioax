<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class HomeController extends Controller
{
    public function index() {
        $categorias = Categoria::all();
        return view('welcome', compact('categorias'));
    }
}
