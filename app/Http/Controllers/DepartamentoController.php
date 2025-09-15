<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    // Listar todos los departamentos
    public function index()
    {
        return response()->json(Departamento::all(), 200);
    }

    // Crear un nuevo departamento
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'subcuenta' => 'required|string|max:3',
        ]);

        $departamento = Departamento::create($request->all());

        return response()->json($departamento, 201);
    }

    // Mostrar un departamento específico
    public function show($id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        return response()->json($departamento, 200);
    }

    // Actualizar un departamento
    public function update(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'subcuenta' => 'sometimes|required|string|max:3',
        ]);

        $departamento->update($request->all());

        return response()->json($departamento, 200);
    }

    // Eliminar un departamento
    public function destroy($id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        $departamento->delete();

        return response()->json(['message' => 'Departamento eliminado'], 200);
    }
}
