<?php

namespace App\Http\Controllers\User;

use App\Models\Produit;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Models\SousCategorie;
use App\Http\Controllers\Controller;

class UserCollectionController extends Controller
{
 // Affiche les collections d'une sous-catégorie
    public function index($idSousCategorie)
    {
        // Charge la sous-catégorie avec ses collections
        $sousCategorie = SousCategorie::with('collections')->findOrFail($idSousCategorie);

        // Récupère les collections liées
        $collections = $sousCategorie->collections;

        return view('pages.frontend.collections.index', compact('sousCategorie', 'collections'));
    }


    public function show($id)
    {
        // Charger la collection
    $collection = Collection::findOrFail($id);

    // Récupérer les produits liés à la collection ET à la sous-catégorie 'tenues'
    // En supposant que la sous-catégorie 'tenues' existe 
    $tenueproduits = $collection->produits()
        ->whereHas('sousCategorie', function($query) {
            $query->where('nom', 'tenues');  // 'nom' est la colonne de sous-catégorie
        })
        ->get();
         
        // Récupérer tous les produits liés à cette collection
    $produits = $collection->produits()->get();


        // Récupérer le produit par défaut (id = 0)
    $produitParDefaut = Produit::find(0); // Retourne null si pas trouvé

    return view('pages.frontend.collections.show', compact('collection', 'produits', 'tenueproduits','produitParDefaut'));
    }




}
