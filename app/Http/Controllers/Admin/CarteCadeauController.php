<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarteCadeau;
use Illuminate\Http\Request;

class CarteCadeauController extends Controller
{
    public function index()
    {
        $cartes = CarteCadeau::paginate(15);
        return view('pages.backend.cartecadeau.index', compact('cartes'));
    }

    public function create()
    {
        return view('pages.backend.cartecadeau.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:100|unique:carte_cadeaus,code',
            'valeur' => 'required|numeric|min:0',
            'date_expiration' => 'nullable|date',
            'statut' => 'required|string|max:50',
        ]);

        CarteCadeau::create($validated);

        return redirect()->route('admin.carte-cadeaus.index')->with('success', 'Carte cadeau créée avec succès.');
    }

    public function show(CarteCadeau $cartecadeau)
    {
        return view('pages.backend.cartecadeau.show', compact('cartecadeau'));
    }

    public function edit(CarteCadeau $cartecadeau)
    {
        return view('pages.backend.cartecadeau.edit', compact('cartecadeau'));
    }

    public function update(Request $request, CarteCadeau $cartecadeau)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:100|unique:carte_cadeaus,code,' . $cartecadeau->id,
            'valeur' => 'required|numeric|min:0',
            'date_expiration' => 'nullable|date',
            'statut' => 'required|string|max:50',
        ]);

        $cartecadeau->update($validated);

        return redirect()->route('admin.carte-cadeaus.index')->with('success', 'Carte cadeau mise à jour avec succès.');
    }

    public function destroy(CarteCadeau $cartecadeau)
    {
        $cartecadeau->delete();

        return redirect()->route('admin.carte-cadeaus.index')->with('success', 'Carte cadeau supprimée.');
    }
}
