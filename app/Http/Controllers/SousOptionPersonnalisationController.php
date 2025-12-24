<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OptionPersonnalisation;
use App\Models\SousOptionPersonnalisation;

class SousOptionPersonnalisationController extends Controller
{
    public function index()
    {
        $sousOptions = SousOptionPersonnalisation::with('option')->get();
        return view('pages.frontend.sousoptionpersonnalisation.index', compact('sousOptions'));
    }

    public function show($id)
    {
        $sousOption = SousOptionPersonnalisation::with('option', 'valeurs')->findOrFail($id);
        return view('pages.frontend.sousoptionpersonnalisation.show', compact('sousOption'));
    }

    public function create()
    {
        $options = OptionPersonnalisation::all();
        return view('pages.frontend.sousoptionpersonnalisation.create', compact('options'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'option_personnalisation_id' => 'required|exists:option_personnalisations,id',
            'nom_sous_option' => 'required|string|max:255',
        ]);

        SousOptionPersonnalisation::create($validated);

        return redirect()->route('sousoptionpersonnalisations.index');
    }

    public function edit($id)
    {
        $sousOption = SousOptionPersonnalisation::findOrFail($id);
        $options = OptionPersonnalisation::all();  // Charge les options pour le select
    return view('pages.frontend.sousoptionpersonnalisation.edit', compact('sousOption', 'options'));
    }

    public function update(Request $request, $id)
    {
        $sousOption = SousOptionPersonnalisation::findOrFail($id);

        $validated = $request->validate([
            'option_personnalisation_id' => 'required|exists:option_personnalisations,id',
            'nom_sous_option' => 'required|string|max:255',
        ]);

        $sousOption->update($validated);

        return redirect()->route('sousoptionpersonnalisations.index');
    }

    public function destroy($id)
    {
        SousOptionPersonnalisation::destroy($id);
        return redirect()->route('sousoptionpersonnalisations.index');
    }
}
