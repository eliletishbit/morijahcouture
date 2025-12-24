<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoLookbook;
use App\Models\Lookbook;
use Illuminate\Http\Request;

class VideoLookbookController extends Controller
{
    public function index()
    {
        $videos = VideoLookbook::with('lookbook')->paginate(15);
        return view('pages.backend.videolookbook.index', compact('videos'));
    }

    public function create()
    {
        $lookbooks = Lookbook::all();
        return view('pages.backend.videolookbook.create', compact('lookbooks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|string|max:255',
            'lookbook_id' => 'required|exists:lookbooks,id',
        ]);

        VideoLookbook::create($validated);

        return redirect()->route('admin.video-lookbooks.index')->with('success', 'Vidéo lookbook créée avec succès.');
    }

    public function show(VideoLookbook $videoLookbook)
    {
        $videoLookbook->load('lookbook');
        return view('pages.backend.videolookbook.show', compact('videoLookbook'));
    }

    public function edit(VideoLookbook $videoLookbook)
    {
        $lookbooks = Lookbook::all();
        return view('pages.backend.videolookbook.edit', compact('videoLookbook', 'lookbooks'));
    }

    public function update(Request $request, VideoLookbook $videoLookbook)
    {
        $validated = $request->validate([
            'url' => 'required|string|max:255',
            'lookbook_id' => 'required|exists:lookbooks,id',
        ]);

        $videoLookbook->update($validated);

        return redirect()->route('admin.video-lookbooks.index')->with('success', 'Vidéo lookbook mise à jour avec succès.');
    }

    public function destroy(VideoLookbook $videoLookbook)
    {
        $videoLookbook->delete();

        return redirect()->route('admin.video-lookbooks.index')->with('success', 'Vidéo lookbook supprimée.');
    }
}
