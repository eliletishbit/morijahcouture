<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['user', 'produits'])->orderBy('created_at', 'desc')->paginate(15);
        return view('pages.backend.commandes.index', compact('commandes'));
    }

    public function show($id)
    {
        $commande = Commande::with(['user', 'produits', 'modeLivraison', 'paiements'])->findOrFail($id);
        return view('pages.backend.commandes.show', compact('commande'));
    }

    public function updateStatut(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->statut = $request->statut;
        $commande->save();

        return redirect()->back()->with('success', 'Statut mis à jour');
    }
}