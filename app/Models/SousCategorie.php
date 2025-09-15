<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousCategorie extends Model
{
    //
     protected $fillable = ['nom', 'categorie_id', 'image'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
    
       public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }
}
