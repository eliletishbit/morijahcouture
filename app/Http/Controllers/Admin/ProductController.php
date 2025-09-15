<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Collection;
use App\Models\SousCategorie;
use App\Models\Materiau;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Produit::with(['collection', 'sousCategorie', 'materiau'])->get();
        return view('pages.backend.produits.index', compact('products'));
    }

    public function create()
    {
        $collections = Collection::all();
        $sousCategories = SousCategorie::all();
        $materiaux = Materiau::all();

        return view('pages.backend.produits.create', compact('collections', 'sousCategories', 'materiaux'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix_base' => 'required|numeric|min:0',
            'collection_id' => 'nullable|exists:collections,id',
            'sous_categorie_id' => 'required|exists:sous_categories,id',
            'personnalisable' => 'required|boolean',
            'type_produit' => 'required|string|max:50',
            'gamme_taille' => 'nullable|string|max:50',
            'materiau_id' => 'nullable|exists:materiaux,id',
            'delai_fabrication' => 'nullable|integer|min:0',
            'delai_livraison' => 'nullable|integer|min:0',
            'image_produit' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_produit')) {
            $path = $request->file('image_produit')->store('produits_images', 'public');
            $data['image_produit'] = $path;
        }

        Produit::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès.');
    }

    public function show(Produit $product)
    {
        return view('pages.backend.produits.show', compact('product'));
    }

    public function edit(Produit $product)
    {
        $collections = Collection::all();
        $sousCategories = SousCategorie::all();
        $materiaux = Materiau::all();

        return view('pages.backend.produits.edit', compact('product', 'collections', 'sousCategories', 'materiaux'));
    }

    public function update(Request $request, Produit $product)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix_base' => 'required|numeric|min:0',
            'collection_id' => 'nullable|exists:collections,id',
            'sous_categorie_id' => 'required|exists:sous_categories,id',
            'personnalisable' => 'required|boolean',
            'type_produit' => 'required|string|max:50',
            'gamme_taille' => 'nullable|string|max:50',
            'materiau_id' => 'nullable|exists:materiaux,id',
            'delai_fabrication' => 'nullable|integer|min:0',
            'delai_livraison' => 'nullable|integer|min:0',
            'image_produit' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_produit')) {
            $path = $request->file('image_produit')->store('produits_images', 'public');
            $data['image_produit'] = $path;
        } else {
            unset($data['image_produit']); // ne pas écraser si pas upload
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé.');
    }
}
