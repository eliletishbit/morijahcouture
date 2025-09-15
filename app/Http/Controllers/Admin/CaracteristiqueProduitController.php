<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Produit;

use App\Models\CaracteristiqueProduit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CaracteristiqueProduitController extends Controller
{
    public function index()
    {
        $caracteristiques = CaracteristiqueProduit::with('categorie')->paginate(15);
        return view('pages.backend.caracteristiquesproduits.index', compact('caracteristiques'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('pages.backend.caracteristiquesproduits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'type' => 'required|string|max:255',
            'valeur' => 'required|string|max:255',
        ]);

        CaracteristiqueProduit::create($request->only('categorie_id', 'type', 'valeur'));

        return redirect()->route('admin.caracteristique-produits.index')->with('success', 'Caractéristique créée avec succès.');
    }

    public function show($id)
    {
        $caracteristique = CaracteristiqueProduit::with('categorie')->findOrFail($id);
        return view('pages.backend.caracteristiquesproduits.show', compact('caracteristique'));
    }

    public function edit($id)
    {
        $caracteristique = CaracteristiqueProduit::findOrFail($id);
        $categories = Categorie::all();
        return view('pages.backend.caracteristiquesproduits.edit', compact('caracteristique', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $caracteristique = CaracteristiqueProduit::findOrFail($id);

        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'type' => 'required|string|max:255',
            'valeur' => 'required|string|max:255',
        ]);

        $caracteristique->update($request->only('categorie_id', 'type', 'valeur'));

        return redirect()->route('admin.caracteristique-produits.index')->with('success', 'Caractéristique mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $caracteristique = CaracteristiqueProduit::findOrFail($id);
        $caracteristique->delete();

        return redirect()->route('admin.caracteristique-produits.index')->with('success', 'Caractéristique supprimée avec succès.');
    }
}