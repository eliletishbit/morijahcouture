<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Categorie;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //liste des catyegories
        $categories = Categorie::all();
        return view('pages.backend.categories.index', compact('categories'));        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //vue pour creer une n,ouvelle categorie
        return view('pages.backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //methode pour enregistrer une nouvelle categorie
        $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom',
            'description' => 'nullable|string',
        ]);

        Categorie::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    public function show(Categorie $category)
    {
        return view('pages.backend.categories.show', compact('category'));
    }


    // Afficher le formulaire d'édition
    public function edit(Categorie $category)
    {
        return view('pages.backend.categories.edit', compact('category'));
    }

    // Mettre à jour une catégorie
    public function update(Request $request, Categorie $category)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    // Supprimer une catégorie
    public function destroy(Categorie $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }

 
   
}
