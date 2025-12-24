<?php

namespace App\Http\Controllers\User;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProductController extends Controller
{
    // Liste des produits personnalisés de l'utilisateur connecté
    public function index()
    {
        $userId = Auth::id();

        // Suppose que le modèle Produit a une relation 'user_id' ou similaire
        $products = Produit::where('user_id', $userId)
                            ->with('collection', 'sousCategorie')
                            ->get();

        return view('user.products.index', compact('products'));
    }

    

    /**
     * Display a listing of the resource.
     */
   public function show(Produit $product)
    {
        $userId = Auth::id();

        // Sécurité : vérifie que le produit appartient bien à l'utilisateur connecté
        if ($product->user_id != $userId) {
            abort(403, 'Accès non autorisé');
        }
        // Chargez ici si besoin des relations comme collection, materiau, etc.
        $product->load('collection', 'sousCategorie', 'materiau', 'pieces', 'optionsValeurs', 'imagesPersonnalisees' );

        $relatedProducts = Produit::where('sous_categorie_id', $product->sous_categorie_id)
                    ->where('id', '!=', $product->id)
                    ->limit(5)
                    ->get();


        return view('pages.frontend.produits.show', compact('product', 'relatedProducts'));
    }


}
