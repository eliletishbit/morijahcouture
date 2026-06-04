<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Mesure;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;

class MesureController extends Controller
{
    /**
     * Display a listing of the resource. ne pas confondre avec une vue inde c'est la vue qui affiche le formulaire d'ajou de mesure
     */
    public function index(Produit $produit)
    {
        //
        $personnalisation = session()->get('personnalisation_' . $produit->id, []);
        
        if (empty($personnalisation)) {
            return redirect()->route('produits.personnalisation', $produit->id)
                ->with('error', 'Veuillez d\'abord personnaliser votre produit.');
        }

        $mesuresExistantes = Mesure::where('user_id', Auth::id())
            ->where('type', 'physique')
            ->latest()
            ->first();

        return view('pages.frontend.mesures.index', compact('produit', 'personnalisation', 'mesuresExistantes'));
    }

    

    /**
     * Store a newly created resource in storage.
     */
           // Enregistrer les mesures
    public function store(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'tour_poitrine' => 'required|numeric|min:30|max:200',
            'tour_taille' => 'required|numeric|min:30|max:200',
            'tour_hanche' => 'required|numeric|min:30|max:200',
            'longueur_manche' => 'required|numeric|min:20|max:150',
            'longueur_totale' => 'required|numeric|min:50|max:250',
            'tour_epaule' => 'nullable|numeric',
            'tour_cou' => 'nullable|numeric',
            'largeur_dos' => 'nullable|numeric',
            'hauteur_taille' => 'nullable|numeric',
            'commentaires' => 'nullable|string',
        ]);

        // Sauvegarde des mesures
        $mesure = Mesure::create([
            'user_id' => Auth::id(),
            'produit_id' => $produit->id,
            'type' => 'physique',
            'data' => $validated,
        ]);

        // On garde la personnalisation en session
        $personnalisation = session()->get('personnalisation_' . $produit->id, []);

        // On enregistre la session panier avec un identifiant unique
        $cartItem = [
            'id' => $produit->id,
            'nom' => $produit->nom,
            'prix' => $this->calculerPrixAvecOptions($produit, $personnalisation),
            'quantite' => 1,
            'image' => $produit->image_produit,
            'personnalisation' => $personnalisation,
            'mesure_id' => $mesure->id,
        ];

        $cart = session()->get('cart', []);
        $cart[$produit->id] = $cartItem;
        session()->put('cart', $cart);

        // Nettoyer la session de personnalisation
        session()->forget('personnalisation_' . $produit->id);

        return redirect()->route('cart.index')->with('success', 'Produit personnalisé ajouté au panier avec vos mesures !');
    }
    

    private function calculerPrixAvecOptions($produit , $personnalisation)
    {
        $prix = $produit->prix_base;

        foreach ($personnalisation as $optionId => $valeurId) {
            $valeur = \App\Models\ValeurOption::find($valeurId);
            if ($valeur && $valeur->prix) {
                $prix += $valeur->prix;
            }
        }

        return $prix;
    }

    //////////////////////////////////////////////////////////////////////////////
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}
