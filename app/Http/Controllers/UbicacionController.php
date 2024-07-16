<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ubicacion;

class UbicacionController extends Controller
{
    public function store(Request $request){

        $ubicacion = new ubicacion;
        $ubicacion->name =$request->latitud;
        $ubicacion->paterno =$request->longitud;
        $ubicacion->save();
    }
}
