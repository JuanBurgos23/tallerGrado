<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\denunciado;

class DenunciadoController extends Controller
{
    public function store(Request $request){
        $denunciado = new denunciado();
        $denunciado->nombre= $request->nombre;
        $denunciado->apellidos= $request->apellidos;
        $denunciado->descripcion= $request->descripcion;
        $denunciado->save();
    }
}
