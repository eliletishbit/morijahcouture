<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\SousCategorie;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::with('sousCategorie')->get();
        return view('pages.backend.collections.index', compact('collections'));
    }

    public function create()
    {
        $sousCategories = SousCategorie::all();
        return view('pages.backend.collections.create', compact('sousCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:collections,nom',
            'image_principale' => 'nullable|string|max:255',
            'sous_categorie_id' => 'required|exists:sous_categories,id',
        ]);

        Collection::create($request->all());

        return redirect()->route('admin.collections.index')->with('success', 'Collection créée avec succès.');
    }

    public function show(Collection $collection)
    {
        return view('pages.backend.collections.show', compact('collection'));
    }

    public function edit(Collection $collection)
    {
        $sousCategories = SousCategorie::all();
        return view('pages.backend.collections.edit', compact('collection', 'sousCategories'));
    }

    public function update(Request $request, Collection $collection)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:collections,nom,' . $collection->id,
            'image_principale' => 'nullable|string|max:255',
            'sous_categorie_id' => 'required|exists:sous_categories,id',
        ]);

        $collection->update($request->all());

        return redirect()->route('pages.admin.collections.index')->with('success', 'Collection mise à jour avec succès.');
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();

        return redirect()->route('pages.admin.collections.index')->with('success', 'Collection supprimée avec succès.');
    }
}
