<?php

namespace App\Http\Controllers\Admin;

use App\Models\ValeurOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OptionPersonnalisation;
use App\Models\SousOptionPersonnalisation;

class ValeurOptionController extends Controller
{
    public function index()
    {
        $valeurOptions = ValeurOption::with('optionPersonnalisation')->paginate(15);
        return view('pages.backend.valeuroptions.index', compact('valeurOptions'));
    }

    public function create()
    {
        $options = OptionPersonnalisation::all();
        $sousOptionsP = SousOptionPersonnalisation::all();
        return view('pages.backend.valeuroptions.create', compact('options','sousOptionsP'));
    }

    public function store(Request $request)
    {
        $request->validate([
             'option_personnalisation_id' => 'required|exists:option_personnalisations,id',
            'sous_option_personnalisation_id' => 'nullable|exists:sous_option_personnalisations,id',
            'valeur' => 'required|string|max:255',
            'image_calque' => 'nullable|image|mimes:png,jpeg,jpg',
            'ordre_calque' => 'integer|min:0',
            'prix' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $valeurOption = new ValeurOption();
        $valeurOption->option_personnalisation_id = $request->option_personnalisation_id;
        $valeurOption->sous_option_personnalisation_id = $request->sous_option_personnalisation_id;
        $valeurOption->valeur = $request->valeur;
        $valeurOption->prix = $request->prix;
        $valeurOption->ordre_calque = $request->ordre_calque;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('valeur_options', 'public');
            $valeurOption->image = $path;
        }

        if ($request->hasFile('image_calque')) {
            $path = $request->file('image_calque')->store('valeur_options_imagecalque', 'public');
            $valeurOption->image_calque = $path;
        }

        $valeurOption->save();

        return redirect()->route('admin.valeur-options.index')->with('success', 'Valeur option créée avec succès.');
    }

    public function show($id)
    {
        $valeurOption = ValeurOption::with('optionPersonnalisation')->findOrFail($id);
        return view('pages.backend.valeuroptions.show', compact('valeurOption'));
    }

    public function edit($id)
    {
        $valeurOption = ValeurOption::findOrFail($id);
        $options = OptionPersonnalisation::all();
        return view('pages.backend.valeuroptions.edit', compact('valeurOption', 'options'));
    }

    public function update(Request $request, $id)
    {
        $valeurOption = ValeurOption::findOrFail($id);

        $request->validate([
           'option_personnalisation_id' => 'required|exists:option_personnalisations,id',
            'sous_option_personnalisation_id' => 'nullable|exists:sous_option_personnalisations,id',
            'valeur' => 'required|string|max:255',
            'prix' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
            'image_calque' => 'nullable|image|mimes:png,jpeg,jpg',
            'ordre_calque' => 'integer|min:0',
        ]);

        $valeurOption->option_personnalisation_id = $request->option_personnalisation_id;
        $valeurOption->sous_option_personnalisation_id = $request->sous_option_personnalisation_id;
        $valeurOption->valeur = $request->valeur;
        $valeurOption->prix = $request->prix;
        $valeurOption->ordre_calque = $request->ordre_calque;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($valeurOption->image && \Storage::disk('public')->exists($valeurOption->image)) {
                \Storage::disk('public')->delete($valeurOption->image);
            }
            $path = $request->file('image')->store('valeur_options_image', 'public');
            $valeurOption->image = $path;
        }else{
              unset($valeurOption->image);
        }

          if ($request->hasFile('image_calque')) {
            // Delete old image if exists
            if ($valeurOption->image_calque && \Storage::disk('public')->exists($valeurOption->image_calque)) {
                \Storage::disk('public')->delete($valeurOption->image_calque);
            }
            $path = $request->file('image_calque')->store('valeur_options_imagecalque', 'public');
            $valeurOption->image_calque = $path;
        }else{
              unset($valeurOption->image_calque);
        }

        $valeurOption->save();

        return redirect()->route('admin.valeur-options.index')->with('success', 'Valeur option mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $valeurOption = ValeurOption::findOrFail($id);
        // Delete image if exists
        if ($valeurOption->image && \Storage::disk('public')->exists($valeurOption->image)) {
            \Storage::disk('public')->delete($valeurOption->image);
        }
        $valeurOption->delete();

        return redirect()->route('admin.valeur-options.index')->with('success', 'Valeur option supprimée avec succès.');
    }
}

