<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AvisProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisProduitController extends Controller
{
    public function index()
    {
        // Listage uniquement des avis de l'utilisateur connecté
        $avis = AvisProduit::where('user_id', Auth::id())->paginate(10);
        return view('pages.user.avisproduit.index', compact('avis'));
    }

    public function create()
    {
        return view('pages.user.avisproduit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|max:500',
        ]);

        $validated['user_id'] = Auth::id();

        AvisProduit::create($validated);

        return redirect()->route('user.avis-produits.index')->with('success', 'Avis ajouté avec succès.');
    }

    public function show(AvisProduit $avisProduit)
    {
        $this->authorize('view', $avisProduit);
        return view('pages.user.avisproduit.show', compact('avisProduit'));
    }

    public function edit(AvisProduit $avisProduit)
    {
        $this->authorize('update', $avisProduit);
        return view('pages.user.avisproduit.edit', compact('avisProduit'));
    }

    public function update(Request $request, AvisProduit $avisProduit)
    {
        $this->authorize('update', $avisProduit);

        $validated = $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|max:500',
        ]);

        $avisProduit->update($validated);

        return redirect()->route('user.avis-produits.index')->with('success', 'Avis mis à jour.');
    }
}
