<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageLookbook;
use App\Models\Lookbook;
use Illuminate\Http\Request;

class ImageLookbookController extends Controller
{
    public function index()
    {
        $images = ImageLookbook::with('lookbook')->paginate(15);
        return view('pages.backend.imagelookbook.index', compact('images'));
    }

    public function create()
    {
        $lookbooks = Lookbook::all();
        return view('pages.backend.imagelookbook.create', compact('lookbooks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|string|max:255',
            'lookbook_id' => 'required|exists:lookbooks,id',
            'is_principale' => 'boolean'
        ]);

        ImageLookbook::create($validated);

        return redirect()->route('admin.image-lookbooks.index')->with('success', 'Image lookbook créée.');
    }

    public function show(ImageLookbook $imageLookbook)
    {
        $imageLookbook->load('lookbook');
        return view('pages.backend.imagelookbook.show', compact('imageLookbook'));
    }

    public function edit(ImageLookbook $imageLookbook)
    {
        $lookbooks = Lookbook::all();
        return view('pages.backend.imagelookbook.edit', compact('imageLookbook', 'lookbooks'));
    }

    public function update(Request $request, ImageLookbook $imageLookbook)
    {
        $validated = $request->validate([
            'url' => 'required|string|max:255',
            'lookbook_id' => 'required|exists:lookbooks,id',
            'is_principale' => 'boolean'
        ]);

        $imageLookbook->update($validated);

        return redirect()->route('admin.image-lookbooks.index')->with('success', 'Image lookbook mise à jour.');
    }

    public function destroy(ImageLookbook $imageLookbook)
    {
        $imageLookbook->delete();

        return redirect()->route('admin.image-lookbooks.index')->with('success', 'Image lookbook supprimée.');
    }
}
