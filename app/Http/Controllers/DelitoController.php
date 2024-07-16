<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\delito;

class DelitoController extends Controller
{
    public function store(Request $request)
    {
        $delito = new delito;
        $delito->nombre = $request->nombre;
        
        $delito->save();
        return redirect()->route('mostrar_delito')->with('success', 'Creado correctamente');
    }

    public function index()
    {
        $delito = delito::all();
        return view('pages.mostrar_delito', compact('delito'));
    }

    public function update(Request $request, $id)
    {
        $delito = delito::find($id);
        $delito->nombre = $request->nombre;
        $delito->update();

        return redirect()->route('mostrar_delito')->with('success', 'Fiscal actualizado correctamente');
    }

    public function edit($id)
    {
        $delito = delito::findOrFail($id); // Cambié $fiscals a $fiscal para ser consistente
        return response()->json($delito); // Devolvemos el fiscal como JSON
    }

    public function create()
    {
        $delitos = delito::all();
        return view('pages.denuncia', compact('delitos'));
    }
}
