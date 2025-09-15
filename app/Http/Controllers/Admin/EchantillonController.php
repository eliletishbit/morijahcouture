<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Echantillon;
use App\Models\CatalogueEchantillon;
use Illuminate\Http\Request;

class EchantillonController extends Controller
{
    public function index()
    {
        $echantillons = Echantillon::with('catalogue')->paginate(15);
        return view('pages.backend.echantillons.index', compact('echantillons'));
    }

    public function create()
    {
        $catalogues = CatalogueEchantillon::all();
        return view('pages.backend.echantillons.create', compact('catalogues'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'type' => 'required|string|max:100',
        'catalogue_id' => 'required|exists:catalogue_echantillons,id',
        'image' => 'nullable|image|max:2048',
    ]);

    $echantillon = new Echantillon();
    $echantillon->nom = $request->nom;
    $echantillon->type = $request->type;
    $echantillon->catalogue_id = $request->catalogue_id;

    if ($request->hasFile('image')) {
        $echantillon->image = $request->file('image')->store('echantillons', 'public');
    }

    $echantillon->save();

    return redirect()->route('admin.echantillons.index')->with('success', 'Échantillon créé avec succès.');
}

    public function show($id)
    {
        $echantillon = Echantillon::with('catalogue')->findOrFail($id);
        return view('pages.backend.echantillons.show', compact('echantillon'));
    }

    public function edit($id)
    {
        $echantillon = Echantillon::findOrFail($id);
        $catalogues = CatalogueEchantillon::all();
        return view('pages.backend.echantillons.edit', compact('echantillon', 'catalogues'));
    }

    public function update(Request $request, $id)
{
    $echantillon = Echantillon::findOrFail($id);

    $request->validate([
        'nom' => 'required|string|max:255',
        'type' => 'required|string|max:100',
        'catalogue_id' => 'required|exists:catalogue_echantillons,id',
        'image' => 'nullable|image|max:2048',
    ]);

    $echantillon->nom = $request->nom;
    $echantillon->type = $request->type;
    $echantillon->catalogue_id = $request->catalogue_id;

    if ($request->hasFile('image')) {
        if ($echantillon->image && Storage::disk('public')->exists($echantillon->image)) {
            Storage::disk('public')->delete($echantillon->image);
        }

        $echantillon->image = $request->file('image')->store('echantillons', 'public');
    }

    $echantillon->save();

    return redirect()->route('admin.echantillons.index')->with('success', 'Échantillon mis à jour avec succès.');
}
    public function destroy($id)
    {
        $echantillon = Echantillon::findOrFail($id);
        $echantillon->delete();

        return redirect()->route('admin.echantillons.index')->with('success', 'Échantillon supprimé avec succès.');
    }
}
