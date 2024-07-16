<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\denunciante;

class DenuncianteController extends Controller
{
    //

    public function store(Request $request)
    {

        $denunciante = new denunciante();
        $denunciante->ci = $request->ci;
        $denunciante->nombre = $request->nombre;
        $denunciante->paterno = $request->paterno;
        $denunciante->materno = $request->materno;
        $denunciante->sexo = $request->sexo;
        $denunciante->domicilio = $request->domicilio;
        $denunciante->telefono = $request->telefono;
        $denunciante->edad = $request->edad;
        $denunciante->estado_civil = $request->estado_civil;
        $denunciante->fecha_nac = $request->fecha_nac;
        $denunciante->nacionalidad = $request->nacionalidad;
        $denunciante->natural_de = $request->natural_de;
        $denunciante->ocupacion = $request->ocupacion;
        $denunciante->save();
        return redirect()->route('dashboard')->with('success', 'creado correctamente');
    }

    public function index()
    {
        // Obtener los denunciantes ordenados de forma descendente y paginados
        $denunciantes = Denunciante::orderBy('created_at', 'desc')->paginate(10);

        // Pasar los denunciantes a la vista
        return view('pages.tables', compact('denunciantes'));
    }

    public function edit($id)
    {
        $denunciante = Denunciante::find($id); // Cambiado a 'Denunciante' en singular
        return view('pages.editar_denunciante', compact('denunciantes'));
    }

    public function update(Request $request, $id)
    {
        $denunciante = Denunciante::find($id);

        $denunciante->ci = $request->ci;
        $denunciante->nombre = $request->nombre;
        $denunciante->paterno = $request->paterno;
        $denunciante->materno = $request->materno;
        $denunciante->sexo = $request->sexo;
        $denunciante->domicilio = $request->domicilio;
        $denunciante->telefono = $request->telefono;
        $denunciante->edad = $request->edad;
        $denunciante->estado_civil = $request->estado_civil;
        $denunciante->fecha_nac = $request->fecha_nac;
        $denunciante->nacionalidad = $request->nacionalidad;
        $denunciante->natural_de = $request->natural_de;
        $denunciante->ocupacion = $request->ocupacion;

        $denunciante->update();

        return redirect()->route('tables')->with('success', 'Denunciante actualizado correctamente');
    }


}