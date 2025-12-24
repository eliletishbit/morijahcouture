<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\CategorieIdeeProduit;

class CategorieIdeeProduitController extends Controller
{
    public function index()
    {
        $categorie_idee_produits = CategorieIdeeProduit::paginate(15);
        return view('pages.backend.categorieideeproduit.index', compact('categorie_idee_produits'));
    }

    public function create()
    {
        return view('pages.backend.categorieideeproduit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        CategorieIdeeProduit::create($validated);

        return redirect()->route('admin.categorie-idee-produits.index')->with('success', 'Catégorie créée.');
    }

    public function show(CategorieIdeeProduit $categorie_idee_produit)
    {
        return view('pages.backend.categorieideeproduit.show', compact('categorie_idee_produit'));
    }

    public function edit(CategorieIdeeProduit $categorie_idee_produit)
    {
        return view('pages.backend.categorieideeproduit.edit', compact('categorie_idee_produit'));
    }

    public function update(Request $request, CategorieIdeeProduit $categorie_idee_produit)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $categorie_idee_produit->update($validated);

        return redirect()->route('admin.categorie-idee-produits.index')->with('success', 'Catégorie mise à jour.');
    }

    public function destroy(CategorieIdeeProduit $categorie_idee_produit)
    {
        $categorie_idee_produit->delete();

        return redirect()->route('admin.categorie-idee-produits.index')->with('success', 'Catégorie supprimée.');
    }
}
