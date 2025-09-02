<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvisProduit extends Model
{
    //
     protected $fillable = ['produit_id', 'nom_client', 'email', 'ville', 'titre', 'commentaire', 'photo', 'note'];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
