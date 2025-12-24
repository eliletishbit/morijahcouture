<?php
use Illuminate\Support\Facades\Route;
use App\Models\CategorieOptionPersonnalisation;



Route::get('/options-categorie/{id}', function($id) {
    $categorie = CategorieOptionPersonnalisation::with('options.sousOptions.valeurs', 'options.valeurs')->findOrFail($id);
    
    return response()->json($categorie);
});


