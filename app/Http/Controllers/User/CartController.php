<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produit;



class CartController extends Controller
{
   public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach($cart as $item) {
            $total += $item['prix'] * $item['quantite'];
        }
        
        return view('pages.frontend.cart.index', compact('cart', 'total'));
    }

    // public function ajouter(Request $request, $produitId)
    // {
    //     $produit = Produit::findOrFail($produitId);
    //     // dd("Ajout produit $produitId");
    //     if ($produit->stock < 1) {
    //         return redirect()->back()->with('error', 'Produit en rupture de stock.');
    //     }

    //     $cart = session()->get('cart', []);
        
    //     if(isset($cart[$produitId])) {
    //         if ($cart[$produitId]['quantite'] >= $produit->stock) {
    //             return redirect()->back()->with('error', 'Stock insuffisant.');
    //         }
    //         $cart[$produitId]['quantite']++;
    //     } else {
    //         $cart[$produitId] = [
    //             "nom" => $produit->nom,
    //             "quantite" => 1,
    //             "prix" => $produit->prix_base,
    //             "image" => $produit->image_produit,
    //             "stock" => $produit->stock
    //         ];
    //     }
        
    //     session()->put('cart', $cart);
    //      // Redirect vers la page panier
    // return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier!');
    // }

    public function ajouter(Request $request, $produitId)
    {
        $produit = Produit::findOrFail($produitId);

        $cart = session()->get('cart', []);

        //le produit existe dejà dans la session ou le panier
        if (isset($cart[$produitId])) {
            // Incrémente la quantité si le produit est déjà dans le panier
             $cart[$produitId]['nom'] = $produit->nom;
              $cart[$produitId]['description'] = $produit->description;
            $cart[$produitId]['quantite']++;
            $cart[$produitId]['prix'] = $produit->prix_base;
            $cart[$produitId]['image'] = $produit->image_produit;
    
        } else {
            // Sinon ajoute le produit avec quantité 1
            $cart[$produitId] = [
                "nom" => $produit->nom,
                "quantite" => 1,
                "prix" => $produit->prix_base,
                "image" => $produit->image_produit,
            ];
        }

        session()->put('cart', $cart);
// dd($produit, $cart);
        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier !');
    }

  
    public function mettreAJour(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantite' => 'required|numeric|min:1'
        ]);

        $cart = session()->get('cart', []);
        
        if(isset($cart[$request->id])) {
            $produit = Produit::find($request->id);
            
            if ($request->quantite > $produit->stock) {
                return redirect()->back()->with('error', 'Stock insuffisant.');
            }
            
            $cart[$request->id]['quantite'] = $request->quantite;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Panier mis à jour!');
        }
        
        return redirect()->back()->with('error', 'Produit non trouvé.');
    }

    public function supprimer(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Produit supprimé!');
        }
        
        return redirect()->back()->with('error', 'Produit non trouvé.');
    }

    public function vider()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Panier vidé!');
    }

}

