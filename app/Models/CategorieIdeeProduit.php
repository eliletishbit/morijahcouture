<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieIdeeProduit extends Model
{
    protected $fillable = ['nom'];

    public function ideeProduits()
{
    return $this->belongsToMany(IdeeProduit::class, 'categorie_idee_produit_idee_produit', 'categorie_idee_produit_id', 'idee_produit_id');
}




}
