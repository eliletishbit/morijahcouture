<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    //
    protected $fillable = [
        'nom', 'description', 'prix_base', 'collection_id', 'sous_categorie_id',
        'personnalisable', 'type_produit', 'gamme_taille', 'tissu_id',
        'delai_fabrication', 'delai_livraison'
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class);
    }

    public function caracteristiques()
    {
        return $this->hasMany(CaracteristiqueProduit::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
                    ->withPivot('quantite', 'prix_unitaire', 'prix_total')
                    ->withTimestamps();
    }
}
