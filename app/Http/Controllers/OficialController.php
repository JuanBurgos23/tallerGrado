<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\oficial;

class OficialController extends Controller
{
    public function store(Request $request)
    {

        $oficial = new oficial;
        $oficial->name = $request->name;
        $oficial->paterno = $request->paterno;
        $oficial->materno = $request->materno;
        $oficial->telefono = $request->telefono;
        $oficial->email = $request->email;
        $oficial->cargo = $request->cargo;
        $oficial->estado = "Disponible";
        $oficial->save();
        return redirect()->route('mostrar_oficial')->with('success', 'creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $oficial = oficial::find($id);
        $oficial->name = $request->name;
        $oficial->paterno = $request->paterno;
        $oficial->materno = $request->materno;
        $oficial->telefono = $request->telefono;
        $oficial->email = $request->email;
        $oficial->cargo = $request->cargo;
        // Actualiza el estado solo si se proporciona en el formulario
        
        $oficial->update();

        return redirect()->route('mostrar_oficial')->with('success', 'Oficial actualizado correctamente');
    }

    public function edit($id)
    {
        $oficial = oficial::findOrFail($id); // Cambié $fiscals a $fiscal para ser consistente
        return response()->json($oficial); // Devolvemos el fiscal como JSON
    }


    public function index()
    {
        $oficials = oficial::all();
        return view('pages.mostrar_oficial', compact('oficials'));
    }

}
