<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produit;
use App\Models\Materiau;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Models\SousCategorie;
use App\Models\ImagePersonnalisee;
use App\Http\Controllers\Controller;
use App\Models\CategorieOptionPersonnalisation;

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

          $categoriesOptions = CategorieOptionPersonnalisation::with('options.sousOptions.valeurs')->get();
        return view('pages.backend.produits.create', compact('collections', 'sousCategories', 'materiaux', 'categoriesOptions'));
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
            'pieces' => 'nullable|array|max:7',
            'pieces.*' => 'exists:produits,id',
            'image_personnalisee' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5 MB max
            'option_personnalisation_id' => 'nullable|exists:option_personnalisations,id',
            'valeur_option_id' => 'nullable|exists:valeur_options,id',


        ]);

        $data = $request->all();

        if ($request->hasFile('image_produit')) {
            $path = $request->file('image_produit')->store('produits_images', 'public');
            $data['image_produit'] = $path;
        }

        // Création du produit (tenue ou simple produit)
        $produit = Produit::create($data);

        // Gestion image personnalisée
       // Si une image personnalisée est uploadée
        if ($request->hasFile('image_personnalisee')) {
            $path = $request->file('image_personnalisee')->store('images_personnalisees', 'public');

            $imagePersonnalisee = ImagePersonnalisee::create(['image' => $path]);

            $optionId = $request->input('option_personnalisation_id');
            $valeurId = $request->input('valeur_option_id');
            // dd($optionId, $valeurId);
            // Vérifiez que ces ids ne sont pas null avant attach
            if ($optionId && $valeurId) { 
                $produit->imagesPersonnalisees()->attach($imagePersonnalisee->id, [
                    'option_personnalisation_id' => $optionId,
                    'valeur_option_id' => $valeurId,
                    'image' => $path,
                ]);
            } else {
                // Gérer le cas où ces ids manquent correctement
                // Par exemple return back avec message d'erreur
            }
        }




        // Si sous catégorie "tenues", rattacher les pièces via table pivot
        $sousCategorie = $produit->sousCategorie()->first();
        if ($sousCategorie && strtolower($sousCategorie->nom) === 'tenues') {
            $pieces = $request->input('pieces', []);
            $produit->pieces()->sync($pieces);
        }

        // Après création ou update du produit
        $optionsSelected = $request->input('options', []); // tableau option_id => valeur_option_id

        // Synchroniser la table pivot
        $syncData = [];      
        foreach ($optionsSelected as $optionId => $valeurId) {
            if ($valeurId !== null && $valeurId !== '') {
                $syncData[$optionId] = ['valeur_option_id' => $valeurId];
            }
        }

        $produit->optionsValeurs()->sync($syncData);
        
        return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès.');
    }

    public function show(Produit $product)
    {
        $product->load('pieces'); // Charge les pièces associées
        return view('pages.backend.produits.show', compact('product'));
    }

    public function edit(Produit $product)
    {
        $collections = Collection::all();
        $sousCategories = SousCategorie::all();
        $materiaux = Materiau::all();

        // $product->load('pieces'); 

        $product->load('optionsValeurs'); // charger options valeurs liées
    $categoriesOptions = CategorieOptionPersonnalisation::with('options.sousOptions.valeurs')->get();


        return view('pages.backend.produits.edit', compact('product', 'collections', 'sousCategories', 'materiaux','categoriesOptions'));
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
            'pieces' => 'nullable|array|max:7',
            'pieces.*' => 'exists:produits,id',
            'image_personnalisee' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5 MB max
            'option_personnalisation_id' => 'nullable|exists:option_personnalisations,id',
            'valeur_option_id' => 'nullable|exists:valeur_options,id',


        ]);

        $data = $request->all();

        // Gestion image
        if ($request->hasFile('image_produit')) {
            $path = $request->file('image_produit')->store('produits_images', 'public');
            $data['image_produit'] = $path;
        } else {
            unset($data['image_produit']); // ne pas écraser si pas uploadé
        }

        $product->update($data);

        // Gestion image personnalisée
       // Si une image personnalisée est uploadée
        if ($request->hasFile('image_personnalisee')) {
            $path = $request->file('image_personnalisee')->store('images_personnalisees', 'public');

            $imagePersonnalisee = ImagePersonnalisee::create(['image' => $path]);

            $optionId = $request->input('option_personnalisation_id');
            $valeurId = $request->input('valeur_option_id');

            // Vérifiez que ces ids ne sont pas null avant attach
            if ($optionId && $valeurId) {
               

                $produit->imagesPersonnalisees()->attach($imagePersonnalisee->id, [
                    'option_personnalisation_id' => $optionId,
                    'valeur_option_id' => $valeurId,
                    'image' => $path,
                ]);
            } else {
                // Gérer le cas où ces ids manquent correctement
                // Par exemple return back avec message d'erreur
            }
        }



        // Mise à jour des pièces si catégorie "tenues"
        $sousCategorie = $product->sousCategorie()->first();
        if ($sousCategorie && strtolower($sousCategorie->nom) === 'tenues') {
            $pieces = $request->input('pieces', []);
            $product->pieces()->sync($pieces);
        } else {
            $product->pieces()->sync([]); // vide les pièces si n'est pas tenue
        }

        // Après création ou update du produit
$optionsSelected = $request->input('options', []); // tableau option_id => valeur_option_id

// Synchroniser la table pivot
        $syncData = [];
        foreach ($optionsSelected as $optionId => $valeurId) {
            if ($valeurId !== null && $valeurId !== '') {
                $syncData[$optionId] = ['valeur_option_id' => $valeurId];
            }
        }

        $produit->optionsValeurs()->sync($syncData);

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé.');
    }
}
