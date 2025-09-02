<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SousCategorie;
use App\Models\Categorie;
use Illuminate\Http\Request;

class SousCategoryController extends Controller
{
    // Affiche la liste des sous-catégories
    public function index()
    {
        $sousCategories = SousCategorie::with('categorie')->get();
        return view('pages.backend.souscategories.index', compact('sousCategories'));
    }

    // Formulaire de création
    public function create()
    {
        $categories = Categorie::all();
        return view('pages.backend.souscategories.create', compact('categories'));
    }

    // Enregistrer une nouvelle sous-catégorie
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:sous_categories,nom',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        SousCategorie::create($request->all());

        return redirect()->route('admin.sous-categories.index')->with('success', 'Sous-catégorie créée avec succès.');
    }

    // Affiche une sous-catégorie précise
    public function show(SousCategorie $sous_category)
    {
        return view('pages.backend.souscategories.show', compact('sous_category'));
    }

    // Formulaire d'édition
    public function edit(SousCategorie $sous_category)
    {
        $categories = Categorie::all();
        return view('pages.backend.souscategories.edit', compact('sous_category', 'categories'));
    }

    // Met à jour la sous-catégorie
    public function update(Request $request, SousCategorie $sous_category)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:sous_categories,nom,' . $sous_category->id,
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $sous_category->update($request->all());

        return redirect()->route('admin.sous-categories.index')->with('success', 'Sous-catégorie mise à jour.');
    }

    // Supprime la sous-catégorie
    public function destroy(SousCategorie $sous_category)
    {
        $sous_category->delete();

        return redirect()->route('admin.sous-categories.index')->with('success', 'Sous-catégorie supprimée.');
    }
}
