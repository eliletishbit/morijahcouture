<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategorieOptionPersonnalisation;

class CategorieOptionPersonnalisationController extends Controller
{
    public function index()
    {
        $categoriesOptions = CategorieOptionPersonnalisation::with('options')->get();
        return view('pages.frontend.categorieoptionpersonnalisation.index', compact('categoriesOptions'));
    }

    public function show($id)
    {
        $categorie = CategorieOptionPersonnalisation::with('options')->findOrFail($id);
        return view('pages.frontend.categorieoptionpersonnalisation.show', compact('categorie'));
    }

    public function create()
    {
        return view('pages.frontend.categorieoptionpersonnalisation.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_categorie' => 'required|string|max:255',
        ]);

        CategorieOptionPersonnalisation::create($validated);

        return redirect()->route('categorieoptionpersonnalisations.index');
    }

    public function edit($id)
    {
        $categorie = CategorieOptionPersonnalisation::findOrFail($id);
        return view('pages.frontend.categorieoptionpersonnalisation.edit', compact('categorie'));
    }

    public function update(Request $request, $id)
    {
        $categorie = CategorieOptionPersonnalisation::findOrFail($id);

        $validated = $request->validate([
            'nom_categorie' => 'required|string|max:255',
        ]);

        $categorie->update($validated);

        return redirect()->route('categorieoptionpersonnalisations.index');
    }

    public function destroy($id)
    {
        CategorieOptionPersonnalisation::destroy($id);
        return redirect()->route('categorieoptionpersonnalisations.index');
    }
}
