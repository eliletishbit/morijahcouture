<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProduitImagePersonnalisee;

class ProduitImagePersonnaliseeController extends Controller
{
    public function index()
    {
        $images = ProduitImagePersonnalisee::with(['produit', 'optionPersonnalisation', 'valeurOption'])->get();
        return view('produit_image_personnalisees.index', compact('images'));
    }

    public function show($id)
    {
        $image = ProduitImagePersonnalisee::with(['produit', 'optionPersonnalisation', 'valeurOption'])->findOrFail($id);
        return view('produit_image_personnalisees.show', compact('image'));
    }

    public function create()
    {
        return view('produit_image_personnalisees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'option_personnalisation_id' => 'required|exists:option_personnalisations,id',
            'valeur_option_id' => 'required|exists:valeur_options,id',
            'image' => 'required|string',
        ]);

        ProduitImagePersonnalisee::create($validated);

        return redirect()->route('produit_image_personnalisees.index');
    }

    public function edit($id)
    {
        $image = ProduitImagePersonnalisee::findOrFail($id);
        return view('produit_image_personnalisees.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $image = ProduitImagePersonnalisee::findOrFail($id);

        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'option_personnalisation_id' => 'required|exists:option_personnalisations,id',
            'valeur_option_id' => 'required|exists:valeur_options,id',
            'image' => 'required|string',
        ]);

        $image->update($validated);

        return redirect()->route('produit_image_personnalisees.index');
    }

    public function destroy($id)
    {
        ProduitImagePersonnalisee::destroy($id);
        return redirect()->route('produit_image_personnalisees.index');
    }
}
