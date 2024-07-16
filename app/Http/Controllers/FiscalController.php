<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fiscal;

class FiscalController extends Controller
{
    public function store(Request $request)
    {
        $fiscal = new Fiscal;
        $fiscal->nombre = $request->nombre;
        $fiscal->paterno = $request->paterno;
        $fiscal->materno = $request->materno;
        $fiscal->telefono = $request->telefono;
        $fiscal->correo = $request->correo;
        $fiscal->estado = "Disponible";
        $fiscal->save();
        return redirect()->route('mostrar_fiscal')->with('success', 'Creado correctamente');
    }

    public function index()
    {
        $fiscals = Fiscal::all();
        return view('pages.mostrar_fiscal', compact('fiscals'));
    }

    public function update(Request $request, $id)
    {
        $fiscal = Fiscal::find($id);
        $fiscal->nombre = $request->nombre;
        $fiscal->paterno = $request->paterno;
        $fiscal->materno = $request->materno;
        $fiscal->telefono = $request->telefono;
        $fiscal->correo = $request->correo;
        
        
        $fiscal->update();
        return redirect()->route('mostrar_fiscal')->with('success', 'Fiscal actualizado correctamente');
    }

    public function edit($id)
    {
        $fiscal = Fiscal::findOrFail($id); // Cambié $fiscals a $fiscal para ser consistente
        return response()->json($fiscal); // Devolvemos el fiscal como JSON
    }
}
