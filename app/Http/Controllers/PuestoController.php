<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    public function index() {
        return Puesto::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
        ]);
        return Puesto::create($validated);
    }

    public function show($id) {
        return Puesto::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $puesto = Puesto::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
        ]);
        $puesto->update($validated);
        return $puesto;
    }

    public function destroy($id) {
        $puesto = Puesto::findOrFail($id);
        $puesto->delete();
        return response()->json(['message' => 'Puesto eliminado']);
    }
}
