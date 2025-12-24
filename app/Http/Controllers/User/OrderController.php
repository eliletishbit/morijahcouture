<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\ModeLivraison;
use App\Models\MethodePaiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Validator\Validate;

class OrderController extends Controller
{
    //
     public function checkout()
    {
        $cart = session()->get('cart', []);
        $user = Auth::user();
        $modesLivraison = ModeLivraison::all();
        $methodesPaiement = MethodePaiement::all();

        if(empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Panier vide.');
        }

        // Vérifier stocks
        foreach($cart as $produitId => $item) {
            $produit = Produit::find($produitId);
            if (!$produit || $produit->stock < $item['quantite']) {
                return redirect()->route('cart.index')
                    ->with('error', "Stock insuffisant pour: {$item['nom']}");
            }
        }
        

        $total = 0;
        foreach($cart as $item) {
            $total += $item['prix'] * $item['quantite'];
        }

        $modesLivraison = ModeLivraison::all();

        return view('pages.frontend.cart.checkout', compact('cart', 'total', 'modesLivraison', 'user', 'methodesPaiement'));
    }

    public function store(Request $request)
    {
        dd($request->all());

       $request->validate([
            'mode_livraison_id' => 'required|exists:mode_livraisons,id',
            'adresse_livraison' => 'required|string|min:5',
            'adresse_facturation' => 'nullable|string',
            'methode_paiement' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);
        
        if(empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Panier vide.');
        }

       return DB::transaction(function () use ($request, $cart) {

            $commande = Commande::create([
                'user_id' => Auth::id(),
                'numero_commande' => Commande::genererNumeroCommande(),
                'mode_livraison_id' => $request->mode_livraison_id,
                'total' => 0, // sera mis à jour ensuite
                'statut' => 'en cours',
                'adresse_livraison' => $request->adresse_livraison,
                'adresse_facturation' => $request->adresse_facturation ?? $request->adresse_livraison,
                'methode_paiement' => $request->methode_paiement,
                'statut_paiement' => 'en attente',
                'notes' => $request->notes,
            ]);

            $totalCommande = 0;

            foreach($cart as $produitId => $item) {
                $produit = Produit::find($produitId);
                $prixTotal = $item['prix'] * $item['quantite'];
                $totalCommande += $prixTotal;

                $commande->ajouterProduit($produitId, $item['quantite'], $item['prix']);

                $produit->decrement('stock', $item['quantite']);
            }

            // Mettre à jour le total de la commande
            $commande->update(['total' => $totalCommande]);
// dd($commande);
            session()->forget('cart');

            return redirect()->route('commandes.show', $commande->id)
                ->with('success', "Commande #{$commande->numero_commande} créée!");
        });

    }

    public function show(Commande $commande)
    {
        if ($commande->user_id !== Auth::id()) {
            abort(403);
        }

        $commande->load(['produits', 'modeLivraison']);

        return view('pages.frontend.commandes.show', compact('commande'));
    }

    public function index()
    {
        $commandes = Commande::where('user_id', Auth::id())
            ->with(['produits', 'modeLivraison'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.frontend.commandes.index', compact('commandes'));
    }


}
