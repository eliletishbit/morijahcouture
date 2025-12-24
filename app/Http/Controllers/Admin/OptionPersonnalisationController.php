<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OptionPersonnalisation;
use App\Models\CategorieOptionPersonnalisation;


class OptionPersonnalisationController extends Controller{
    public function index()
    {
        $options = OptionPersonnalisation::with(['produit', 'categorie', 'sousOptions.valeurs'])->paginate(10);
        return view('pages.frontend.optionspersonnalisations.index', compact('options'));
    }

    public function show($id)
    {
        $option = OptionPersonnalisation::with(['produit', 'categorie', 'sousOptions.valeurs'])->findOrFail($id);
        return view('pages.frontend.optionspersonnalisations.show', compact('option'));
    }

    public function create()
    {
        $categoriesOptionsP = CategorieOptionPersonnalisation::all();
        
        return view('pages.frontend.optionspersonnalisations.create', compact('categoriesOptionsP'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produit_id' => 'nullable|exists:produits,id',
            'categorie_option_personnalisation_id' => 'required|exists:categorie_option_personnalisations,id',
            'nom_option' => 'required|string|max:255',
            'type_option' => 'required|string|max:255',
        ]);

        OptionPersonnalisation::create($validated);

        return redirect()->route('admin.option-personnalisations.index');
    }

    public function edit($id)
    {
        
    $categories = CategorieOptionPersonnalisation::all();
        $option = OptionPersonnalisation::findOrFail($id);
        return view('pages.frontend.optionspersonnalisations.edit', compact('option', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $option = OptionPersonnalisation::findOrFail($id);

        $validated = $request->validate([
            'produit_id' => 'nullable|exists:produits,id',
            'categorie_option_personnalisation_id' => 'required|exists:categorie_option_personnalisations,id',
            'nom_option' => 'required|string|max:255',
            'type_option' => 'required|string|max:255',
        ]);

        $option->update($validated);

        return redirect()->route('admin.option-personnalisations.index');
    }

    public function destroy($id)
    {
        OptionPersonnalisation::destroy($id);
        return redirect()->route('admin.option-personnalisations.index');
    }
}