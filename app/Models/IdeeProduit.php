<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdeeProduit extends Model
{
    //
    protected $fillable = ['nom'];

public function categorieIdeeProduits()
{
    return $this->belongsToMany(CategorieIdeeProduit::class, 'categorie_idee_produit_idee_produit', 'idee_produit_id', 'categorie_idee_produit_id');
}


   
}

 //nb: Le modèle pivot CategorieIdeeProduit n’a pas besoin d’un modèle dédié (utilisation implicite par Eloquent