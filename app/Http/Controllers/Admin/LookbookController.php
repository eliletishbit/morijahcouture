<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lookbook;
use Illuminate\Http\Request;

class LookbookController extends Controller
{
    public function index()
    {
        $lookbooks = Lookbook::paginate(15);
        return view('pages.backend.lookbook.index', compact('lookbooks'));
    }

    public function create()
    {
        return view('pages.backend.lookbook.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'sous_titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|string|max:50',
        ]);

        Lookbook::create($validated);

        return redirect()->route('admin.lookbooks.index')->with('success', 'Lookbook créé avec succès.');
    }

    public function show(Lookbook $lookbook)
    {
        return view('pages.backend.lookbook.show', compact('lookbook'));
    }

    public function edit(Lookbook $lookbook)
    {
        return view('pages.backend.lookbook.edit', compact('lookbook'));
    }

    public function update(Request $request, Lookbook $lookbook)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'sous_titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|string|max:50',
        ]);

        $lookbook->update($validated);

        return redirect()->route('admin.lookbooks.index')->with('success', 'Lookbook mis à jour avec succès.');
    }

    public function destroy(Lookbook $lookbook)
    {
        $lookbook->delete();

        return redirect()->route('admin.lookbooks.index')->with('success', 'Lookbook supprimé avec succès.');
    }
}
