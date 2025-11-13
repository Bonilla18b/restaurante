<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        return view('menus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:menus,nombre|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'disponibilidad' => 'boolean',
            'registradoPor' => 'nullable|string|max:100',
        ]);

        Menu::create($validated);
        return redirect()->route('menus.index')->with('success', 'Ítem de menú creado.');
    }

    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:menus,nombre,' . $menu->id . '|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'disponibilidad' => 'boolean',
        ]);

        $menu->update($validated);
        return redirect()->route('menus.index')->with('success', 'Ítem de menú actualizado.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Ítem de menú eliminado.');
    }
}