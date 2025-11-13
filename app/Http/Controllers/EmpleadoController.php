<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Persona;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('persona')->get();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $personas = Persona::doesntHave('empleado')->get(); // Personas que aún no son empleados
        return view('empleados.create', compact('personas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'persona_id' => 'required|exists:personas,id|unique:empleados,persona_id',
            'cargo' => 'required|string|max:100',
            'salario' => 'required|numeric|min:0',
            'turno' => 'required|string|max:50',
            'estado' => 'required|string|in:Activo,Inactivo,Suspendido',
            'contratacion' => 'required|date',
            'registradoPor' => 'nullable|string|max:100',
        ]);

        Empleado::create($validated);
        return redirect()->route('empleados.index')->with('success', 'Empleado contratado.');
    }

    public function show(Empleado $empleado)
    {
        return view('empleados.show', compact('empleado'));
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([
            'cargo' => 'required|string|max:100',
            'salario' => 'required|numeric|min:0',
            'turno' => 'required|string|max:50',
            'estado' => 'required|string|in:Activo,Inactivo,Suspendido',
            'contratacion' => 'required|date',
        ]);

        $empleado->update($validated);
        return redirect()->route('empleados.index')->with('success', 'Datos de empleado actualizados.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado.');
    }
}