<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogueEchantillon;
use Illuminate\Http\Request;

class CatalogueEchantillonController extends Controller
{
    public function index()
    {
        $catalogues = CatalogueEchantillon::paginate(15);
        return view('pages.backend.cataloguechantillons.index', compact('catalogues'));
    }

    public function create()
    {
        return view('pages.backend.cataloguechantillons.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $catalogue = new CatalogueEchantillon();
    $catalogue->nom = $request->nom;
    $catalogue->description = $request->description;

    if ($request->hasFile('image')) {
        $catalogue->image = $request->file('image')->store('catalogue_echantillons', 'public');
    }

    $catalogue->save();

    return redirect()->route('admin.catalogue-echantillons.index')->with('success', 'Catalogue créé avec succès.');
}

public function update(Request $request, $id)
{
    $catalogue = CatalogueEchantillon::findOrFail($id);

    $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $catalogue->nom = $request->nom;
    $catalogue->description = $request->description;

    if ($request->hasFile('image')) {
        // Supprimer ancienne image si présente
        if ($catalogue->image && Storage::disk('public')->exists($catalogue->image)) {
            Storage::disk('public')->delete($catalogue->image);
        }

        $catalogue->image = $request->file('image')->store('catalogue_echantillons', 'public');
    }

    $catalogue->save();

    return redirect()->route('admin.catalogue-echantillons.index')->with('success', 'Catalogue mis à jour avec succès.');
}

    public function show($id)
    {
        $catalogue = CatalogueEchantillon::findOrFail($id);
        return view('pages.backend.cataloguechantillons.show', compact('catalogue'));
    }

    public function edit($id)
    {
        $catalogue = CatalogueEchantillon::findOrFail($id);
        return view('pages.backend.cataloguechantillons.edit', compact('catalogue'));
    }

    

    public function destroy($id)
    {
        $catalogue = CatalogueEchantillon::findOrFail($id);
        $catalogue->delete();

        return redirect()->route('admin.catalogue-echantillons.index')->with('success', 'Catalogue supprimé avec succès.');
    }
}
