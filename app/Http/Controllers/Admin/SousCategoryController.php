<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\SousCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use App\Models\CategorieOptionPersonnalisation;

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
         $categoriesOptions = CategorieOptionPersonnalisation::all();
        return view('pages.backend.souscategories.create', compact('categories', 'categoriesOptions'));
    }

    // Enregistrer une nouvelle sous-catégorie
     public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
              'categorie_option_personnalisation_id' => 'nullable|exists:categorie_option_personnalisations,id',
            'image' => 'nullable|image', // validation image optionnelle
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('sous_categories_images', 'public');
            $data['image'] = $path;
        }

        SousCategorie::create($data);

        return redirect()->route('admin.sous-categories.index')->with('success', 'Sous-catégorie ajoutée avec succès.');
   
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
        $categoriesOptions = CategorieOptionPersonnalisation::all();
        return view('pages.backend.souscategories.edit', compact('sous_category', 'categories', 'categoriesOptions'));
    }

    // Met à jour la sous-catégorie
   public function update(Request $request, SousCategorie $sous_category)
{
    $request->validate([
        'nom' => 'required|string|max:255|unique:sous_categories,nom,' . $sous_category->id,
        'categorie_id' => 'required|exists:categories,id',
        'categorie_option_personnalisation_id' => 'nullable|exists:categorie_option_personnalisations,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
    ]);

    // Préparer les données à mettre à jour
    $data = [
        'nom' => $request->nom,
        'categorie_id' => $request->categorie_id,
        'categorie_option_personnalisation_id' => $request->categorie_option_personnalisation_id, // ← AJOUTE CETTE LIGNE
    ];

    // Gérer l'image
    if ($request->hasFile('image')) {
        if ($sous_category->image && Storage::disk('public')->exists($sous_category->image)) {
            Storage::disk('public')->delete($sous_category->image);
        }
        $path = $request->file('image')->store('sous_categories_images', 'public');
        $data['image'] = $path;
    }

    $sous_category->update($data);

    return redirect()->route('admin.sous-categories.index')->with('success', 'Sous-catégorie mise à jour avec succès.');
}

    // Supprime la sous-catégorie
    public function destroy(SousCategorie $sous_category)
    {
        // Supprimer l'image associée
        if ($sous_category->image && Storage::disk('public')->exists($sous_category->image)) {
            Storage::disk('public')->delete($sous_category->image);
        }
        $sous_category->delete();

        return redirect()->route('admin.sous-categories.index')->with('success', 'Sous-catégorie supprimée.');
    }
}
