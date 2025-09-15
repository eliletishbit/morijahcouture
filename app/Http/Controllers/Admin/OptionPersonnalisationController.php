<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionPersonnalisation;
use Illuminate\Http\Request;

class OptionPersonnalisationController extends Controller
{
    public function index()
    {
        $options = OptionPersonnalisation::paginate(15);
        return view('pages.backend.optionspersonnalisations.index', compact('options'));
    }

    public function create()
    {
        return view('pages.backend.optionspersonnalisations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_option' => 'required|string|max:255',
            'type_option' => 'required|string|max:100',
        ]);

        OptionPersonnalisation::create($request->only('nom_option', 'type_option'));

        return redirect()->route('admin.option-personnalisations.index')->with('success', 'Option de personnalisation créée avec succès.');
    }

    public function show($id)
    {
        $option = OptionPersonnalisation::findOrFail($id);
        return view('pages.backend.optionspersonnalisations.show', compact('option'));
    }

    public function edit($id)
    {
        $option = OptionPersonnalisation::findOrFail($id);
        return view('pages.backend.optionspersonnalisations.edit', compact('option'));
    }

    public function update(Request $request, $id)
    {
        $option = OptionPersonnalisation::findOrFail($id);

        $request->validate([
            'nom_option' => 'required|string|max:255',
            'type_option' => 'required|string|max:100',
        ]);

        $option->update($request->only('nom_option', 'type_option'));

        return redirect()->route('admin.option-personnalisations.index')->with('success', 'Option de personnalisation mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $option = OptionPersonnalisation::findOrFail($id);
        $option->delete();

        return redirect()->route('admin.option-personnalisations.index')->with('success', 'Option de personnalisation supprimée avec succès.');
    }
}
