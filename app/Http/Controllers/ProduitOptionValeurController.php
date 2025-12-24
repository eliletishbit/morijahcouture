<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProduitOptionValeur;

class ProduitOptionValeurController extends Controller
{
    public function index()
    {
        $liens = ProduitOptionValeur::with(['produit', 'optionPersonnalisation', 'valeurOption'])->get();
        return view('produit_option_valeurs.index', compact('liens'));
    }

    public function show($id)
    {
        $lien = ProduitOptionValeur::with(['produit', 'optionPersonnalisation', 'valeurOption'])->findOrFail($id);
        return view('produit_option_valeurs.show', compact('lien'));
    }
}
