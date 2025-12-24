<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IdeeProduit;
use Illuminate\Http\Request;

class IdeeProduitController extends Controller
{
    public function index()
    {
        $idee_produits = IdeeProduit::paginate(15);
        return view('pages.backend.ideeproduit.index', ['idee_produits' => $idee_produits]);
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

    // public function show(IdeeProduit $idee_produit)
    // {
    //     return view('pages.backend.ideeproduit.show', compact('idee_produit'));
    // }

    // public function edit(IdeeProduit $idee_produit)
    // {
    //     return view('pages.backend.ideeproduit.edit', compact('idee_produit'));
    // }

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
