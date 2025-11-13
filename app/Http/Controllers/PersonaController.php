<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    // Mostrar lista de Personas
    public function index()
    {
        $personas = Persona::all();
        return view('personas.index', compact('personas'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('personas.create');
    }

    // Almacenar nueva Persona
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'documento' => 'required|string|unique:personas,documento|max:50',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:personas,email|max:255',
        ]);

        Persona::create($validated);
        return redirect()->route('personas.index')->with('success', 'Persona creada correctamente.');
    }

    // Mostrar una Persona específica (Route Model Binding)
    public function show(Persona $persona)
    {
        return view('personas.show', compact('persona'));
    }

    // Mostrar formulario de edición
    public function edit(Persona $persona)
    {
        return view('personas.edit', compact('persona'));
    }

    // Actualizar Persona
    public function update(Request $request, Persona $persona)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'documento' => 'required|string|unique:personas,documento,' . $persona->id . '|max:50',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:personas,email,' . $persona->id . '|max:255',
        ]);

        $persona->update($validated);
        return redirect()->route('personas.index')->with('success', 'Persona actualizada correctamente.');
    }

    // Eliminar Persona
    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->route('personas.index')->with('success', 'Persona eliminada.');
    }
}