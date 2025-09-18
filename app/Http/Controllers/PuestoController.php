<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use App\Http\Resources\PuestoResource;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    public function index() {
        // ✅ Ya usa with() para cargar relaciones
        $puestos = Puesto::with('departamento')->get();
        return PuestoResource::collection($puestos);
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'departamento_id' => 'required|exists:departamento,id'
        ]);

        $puesto = Puesto::create($request->all());
        // Cargar relación para el response
        $puesto->load('departamento');
        return new PuestoResource($puesto);
    }

    public function show($id) {
        $p = Puesto::with('departamento')->find($id);
        if (!$p) return response()->json(['message' => 'No encontrado'], 404);
        return new PuestoResource($p);
    }

    public function update(Request $request, $id) {
        $p = Puesto::with('departamento')->find($id);
        if (!$p) return response()->json(['message' => 'No encontrado'], 404);

        $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'departamento_id' => 'sometimes|required|exists:departamento,id'
        ]);

        $p->update($request->all());
        $p->load('departamento'); // Recargar relación
        return new PuestoResource($p);
    }

    public function destroy($id) {
        $p = Puesto::find($id);
        if (!$p) return response()->json(['message' => 'No encontrado'], 404);

        $p->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
