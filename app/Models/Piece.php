<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    //une piece est lie a un produit ou tenueproduit(un produit mais en meme temps tenue cad composer de pls pieces)
    protected $fillable = ['nom', 'image', 'description'];

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'piece_produit');
    }
}
