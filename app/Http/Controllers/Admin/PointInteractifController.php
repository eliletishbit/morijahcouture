<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointInteractif;
use App\Models\ImageLookbook;
use App\Models\Produit;
use Illuminate\Http\Request;

class PointInteractifController extends Controller
{
    public function index()
    {
        $points = PointInteractif::with(['imageLookbook', 'produit'])->paginate(15);
        return view('pages.backend.pointinteractif.index', compact('points'));
    }

    public function create()
    {
        $images = ImageLookbook::all();
        $produits = Produit::all();
        return view('pages.backend.pointinteractif.create', compact('images', 'produits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image_lookbook_id' => 'required|exists:image_lookbooks,id',
            'produit_id' => 'nullable|exists:produits,id',
            'position_x' => 'required|numeric|between:0,1',
            'position_y' => 'required|numeric|between:0,1',
            'description_popup' => 'nullable|string',
        ]);

        PointInteractif::create($validated);

        return redirect()->route('admin.point-interactifs.index')->with('success', 'Point interactif créé.');
    }

    public function show(PointInteractif $pointInteractif)
    {
        $pointInteractif->load(['imageLookbook', 'produit']);
        return view('pages.backend.pointinteractif.show', compact('pointInteractif'));
    }

    public function edit(PointInteractif $pointInteractif)
    {
        $images = ImageLookbook::all();
        $produits = Produit::all();
        return view('pages.backend.pointinteractif.edit', compact('pointInteractif', 'images', 'produits'));
    }

    public function update(Request $request, PointInteractif $pointInteractif)
    {
        $validated = $request->validate([
            'image_lookbook_id' => 'required|exists:image_lookbooks,id',
            'produit_id' => 'nullable|exists:produits,id',
            'position_x' => 'required|numeric|between:0,1',
            'position_y' => 'required|numeric|between:0,1',
            'description_popup' => 'nullable|string',
        ]);

        $pointInteractif->update($validated);

        return redirect()->route('admin.point-interactifs.index')->with('success', 'Point interactif mis à jour.');
    }

    public function destroy(PointInteractif $pointInteractif)
    {
        $pointInteractif->delete();

        return redirect()->route('admin.point-interactifs.index')->with('success', 'Point interactif supprimé.');
    }
}
