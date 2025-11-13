<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Empleado;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function index()
    {
        $contratos = Contrato::with('empleado.persona')->get();
        return view('contratos.index', compact('contratos'));
    }

    public function create()
    {
        $empleados = Empleado::all(); 
        return view('contratos.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'tipoContrato' => 'required|string|max:100',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after:fechaInicio',
            'estadoContrato' => 'required|string|in:Vigente,Finalizado,Renovación',
            'salario' => 'required|numeric|min:0',
        ]);

        Contrato::create($validated);
        return redirect()->route('contratos.index')->with('success', 'Contrato creado.');
    }

    public function show(Contrato $contrato)
    {
        return view('contratos.show', compact('contrato'));
    }

    public function edit(Contrato $contrato)
    {
        $empleados = Empleado::all();
        return view('contratos.edit', compact('contrato', 'empleados'));
    }

    public function update(Request $request, Contrato $contrato)
    {
        $validated = $request->validate([
            'tipoContrato' => 'required|string|max:100',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after:fechaInicio',
            'estadoContrato' => 'required|string|in:Vigente,Finalizado,Renovación',
            'salario' => 'required|numeric|min:0',
        ]);

        $contrato->update($validated);
        return redirect()->route('contratos.index')->with('success', 'Contrato actualizado.');
    }

    public function destroy(Contrato $contrato)
    {
        $contrato->delete();
        return redirect()->route('contratos.index')->with('success', 'Contrato eliminado.');
    }
}