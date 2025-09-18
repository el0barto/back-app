<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    public function index() {
        // Cargar puestos con sus departamentos
        $puestos = Puesto::with('departamento')->get();
        return response()->json($puestos);
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:100',
        ]);

        $puesto = Puesto::create($request->all());
        return response()->json($puesto, 201);
    }

    public function show($id) {
        $p = Puesto::find($id);
        if (!$p) return response()->json(['message' => 'No encontrado'], 404);
        return response()->json($p, 200);
    }

    public function update(Request $request, $id) {
        $p = Puesto::find($id);
        if (!$p) return response()->json(['message' => 'No encontrado'], 404);

        $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
        ]);

        $p->update($request->all());
        return response()->json($p, 200);
    }

    public function destroy($id) {
        $p = Puesto::find($id);
        if (!$p) return response()->json(['message' => 'No encontrado'], 404);

        $p->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
