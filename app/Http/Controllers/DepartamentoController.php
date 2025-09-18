<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Http\Resources\DepartamentoResource;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index() {
        $departamentos = Departamento::all();
        return DepartamentoResource::collection($departamentos);
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'subcuenta' => 'required|string|max:3',
        ]);

        $departamento = Departamento::create($request->all());
        return new DepartamentoResource($departamento);
    }

    public function show($id) {
        $dep = Departamento::find($id);
        if (!$dep) return response()->json(['message' => 'No encontrado'], 404);
        return new DepartamentoResource($dep);
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
        return new DepartamentoResource($dep);
    }

    public function destroy($id) {
        $dep = Departamento::find($id);
        if (!$dep) return response()->json(['message' => 'No encontrado'], 404);

        $dep->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}