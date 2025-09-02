<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    //
    protected $fillable = ['user_id', 'mode_livraison_id', 'total', 'statut'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modeLivraison()
    {
        return $this->belongsTo(ModeLivraison::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
                    ->withPivot('quantite', 'prix_unitaire', 'prix_total')
                    ->withTimestamps();
    }
    

}
