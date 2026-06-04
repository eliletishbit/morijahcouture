<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IdeeProduit;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SousCategorie;
use App\Models\Produit;

class IdeeProduitController extends Controller
{
    public function index()
    {
      // Récupérer l'ID de la sous-catégorie "ideeproduit"
        
         $sousCategorieIdeeProduit = SousCategorie::where('nom', 'ideeproduit')->first();
        $produitsIdee = [];
        
        if ($sousCategorieIdeeProduit) {
           // Top 10 produits dont la sous_categorie_id est celle de "ideeproduit"
            $produitsIdee = Produit::where('sous_categorie_id', $sousCategorieIdeeProduit->id)
                ->limit(10)
                ->get();
        }
        
        return view('welcome', ['tenueproduits' => $produitsIdee]);
    }

      // API pour récupérer les pièces d'un produit
    public function getPieces($produitId)
    {
        $produit = Produit::with('pieces')->findOrFail($produitId);
        
        return response()->json([
            'produit' => [
                'id' => $produit->id,
                'nom' => $produit->nom,
                'image_produit' => $produit->image_produit
            ],
            'pieces' => $produit->pieces->map(function($piece) {
                return [
                    'id' => $piece->id,
                    'nom' => $piece->nom,
                    'prix_base' => $piece->prix_base,
                    'image_produit' => $piece->image_produit,
                    'type_produit' => $piece->type_produit
                ];
            })
        ]);
    }

    public function create()
    {
        return view('pages.backend.ideeproduit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        IdeeProduit::create($validated);

        return redirect()->route('admin.idee-produits.index')->with('success', 'Idée produit créée.');
    }

  

    public function show(IdeeProduit $idee_produit)
    {
        return view('pages.backend.ideeproduit.show', compact('idee_produit'));
    }

    public function edit(IdeeProduit $idee_produit)
    {
        return view('pages.backend.ideeproduit.edit', compact('idee_produit'));
    }

    public function update(Request $request, IdeeProduit $idee_produit)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $idee_produit->update($validated);

        return redirect()->route('admin.idee-produits.index')->with('success', 'Idée produit mise à jour.');
    }

    public function destroy(IdeeProduit $idee_produit)
    {
        $idee_produit->delete();

        return redirect()->route('admin.idee-produits.index')->with('success', 'Idée produit supprimée.');
    }
}
