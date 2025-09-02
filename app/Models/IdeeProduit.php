<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdeeProduit extends Model
{
    //
    protected $fillable = ['nom'];

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'categorie_idee_produit');
    }

   
}

 //nb: Le modèle pivot CategorieIdeeProduit n’a pas besoin d’un modèle dédié (utilisation implicite par Eloquent