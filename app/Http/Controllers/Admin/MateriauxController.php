<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materiau;
use Illuminate\Http\Request;

class MateriauxController extends Controller
{
    public function index()
    {
        $materiaux = Materiau::paginate(15);
        return view('admin.materiaux.index', compact('materiaux'));
    }

    public function create()
    {
        return view('admin.materiaux.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Materiau::create($request->only('nom', 'description'));

        return redirect()->route('admin.materiaux.index')->with('success', 'Matériau créé avec succès.');
    }

    public function show($id)
    {
        $materiau = Materiau::findOrFail($id);
        return view('admin.materiaux.show', compact('materiau'));
    }

    public function edit($id)
    {
        $materiau = Materiau::findOrFail($id);
        return view('admin.materiaux.edit', compact('materiau'));
    }

    public function update(Request $request, $id)
    {
        $materiau = Materiau::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $materiau->update($request->only('nom', 'description'));

        return redirect()->route('admin.materiaux.index')->with('success', 'Matériau mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $materiau = Materiau::findOrFail($id);
        $materiau->delete();

        return redirect()->route('admin.materiaux.index')->with('success', 'Matériau supprimé avec succès.');
    }
}
