<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AvisProduit;
use Illuminate\Http\Request;

class AvisProduitController extends Controller
{
    // Liste des avis (page index)
    public function index()
    {
        $avis = AvisProduit::with(['produit', 'user'])->paginate(15);
        return view('pages.backend.avisproduit.index', compact('avis'));
    }

    // Pas de création par admin, les avis sont fournis par les clients
    // suppression d’un avis possible

    public function destroy(AvisProduit $avisProduit)
    {
        $avisProduit->delete();

        return redirect()->route('admin.avis-produits.index')->with('success', 'Avis produit supprimé.');
    }
}
