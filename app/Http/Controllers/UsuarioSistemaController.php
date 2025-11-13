<?php

namespace App\Http\Controllers;

use App\Models\UsuarioSistema;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioSistemaController extends Controller
{
    public function index()
    {
        $usuarios = UsuarioSistema::with('empleado.persona')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        // Empleados que no tienen cuenta de sistema
        $empleados = Empleado::doesntHave('usuario')->get(); 
        return view('usuarios.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'empleado_id' => 'required|exists:empleados,id|unique:usuarios_sistema,empleado_id',
            'username' => 'required|string|unique:usuarios_sistema,username|max:255',
            'password' => 'required|string|min:6|confirmed', // 'confirmed' busca un campo 'password_confirmation'
            'registradoPor' => 'nullable|string|max:100',
        ]);

        UsuarioSistema::create([
            'empleado_id' => $validated['empleado_id'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'registradoPor' => $validated['registradoPor'],
        ]);
        
        return redirect()->route('usuarios.index')->with('success', 'Usuario de sistema creado.');
    }

    public function show(UsuarioSistema $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(UsuarioSistema $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, UsuarioSistema $usuario)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:usuarios_sistema,username,' . $usuario->id . '|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = ['username' => $validated['username']];
        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $usuario->update($data);
        return redirect()->route('usuarios.index')->with('success', 'Usuario de sistema actualizado.');
    }

    public function destroy(UsuarioSistema $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario de sistema eliminado.');
    }
}