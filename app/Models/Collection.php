<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //
    protected $fillable = ['nom', 'image_principale', 'sous_categorie_id'];

    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class, 'sous_categorie_id');
    }

    public function produits()
    {
        return $this->hasMany(Produit::class, 'collection_id');
    }
}
