<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdeeProduit extends Model
{
    //
    protected $fillable = ['nom'];


   // Relation avec les produits (many-to-many)
    public function produits(): BelongsToMany
    {
        return $this->belongsToMany(Produit::class, 'produit_idee_produit')
                    ->withPivot('ordre')
                    ->withTimestamps();
    }

   
}

 //nb: Le modèle pivot CategorieIdeeProduit n’a pas besoin d’un modèle dédié (utilisation implicite par Eloquent