<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\SousCategorie;
use App\Models\Piece;


class WelcomeController extends Controller
{
    //injection de toutes les ependances de l'accueil
    public function index()
    {
        // Récupérer les top 20 produits de la sous-catégorie "tenues" avec leurs pièces liées
        $tenueproduits = Produit::whereHas('sousCategorie', function($query) {
            $query->where('nom', 'tenues');
        })->with('pieces')->take(20)->get();

        // Récupérer les sous-catégories dont categorie_id = 1 / 1 POUR VETEMENTS
        $sousCategories = SousCategorie::where('categorie_id', 1)->get();

        // Récupérer toutes les catégories
        $categories = Categorie::all();

        // Récupérer tous les produits
        $produits = Produit::all();

        return view('welcome', compact('categories', 'produits', 'sousCategories', 'tenueproduits'));
    }

    public function shop(){
        $categories = Categorie::all();
        $sousCategories = SousCategorie::all();
        $products= Produit::paginate(12);

        return view('pages.frontend.shop.grid', compact('categories','products','sousCategories'));
    }

    

}
