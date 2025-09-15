<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index() {
        return response()->json(Departamento::all(), 200);
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'subcuenta' => 'required|string|max:3',
        ]);

        $departamento = Departamento::create($request->all());
        return response()->json($departamento, 201);
    }

    public function show($id) {
        $dep = Departamento::find($id);
        if (!$dep) return response()->json(['message' => 'No encontrado'], 404);
        return response()->json($dep, 200);
    }

    public function update(Request $request, $id) {
        $dep = Departamento::find($id);
        if (!$dep) return response()->json(['message' => 'No encontrado'], 404);

        $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'subcuenta' => 'sometimes|required|string|max:3',
        ]);

        $dep->update($request->all());
        return response()->json($dep, 200);
    }

    public function destroy($id) {
        $dep = Departamento::find($id);
        if (!$dep) return response()->json(['message' => 'No encontrado'], 404);

        $dep->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
