<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    //
    protected $fillable = ['nom', 'description'];

    public function sousCategories()
    {
        return $this->hasMany(SousCategorie::class);
    }

    public function caracteristiques(): HasMany
    {
        return $this->hasMany(CaracteristiqueProduit::class);
    }

    // Relations supplémentaires possibles, ex : produits
    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }
}
