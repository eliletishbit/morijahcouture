<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvisProduit extends Model
{
    //
     protected $fillable = ['produit_id', 'nom_client', 'email', 'ville', 'titre', 'commentaire', 'photo', 'note'];

     protected $table= 'avis_produis';
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
