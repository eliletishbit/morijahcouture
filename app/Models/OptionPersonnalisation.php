<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionPersonnalisation extends Model
{
    //
    protected $fillable = [
        'produit_id',
        'categorie_option_personnalisation_id',
        'nom_option',
        'type_option'
    ];

    // Option appartenant à un produit (nullable)
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    // L'option appartient à une catégorie d'option
    public function categorie()
    {
        return $this->belongsTo(CategorieOptionPersonnalisation::class, 'categorie_option_personnalisation_id');
    }

    // Sous-options liées (option comporte plusieurs sous-options)
    public function sousOptions()
    {
        return $this->hasMany(SousOptionPersonnalisation::class);
    }

    // Valeurs directes si option simple (exemple : tissus sans sous-options)
    public function valeurs()
    {
        return $this->hasMany(ValeurOption::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'produit_option_valeur')
                    ->using(ProduitOptionValeur::class)
                    ->withPivot('valeur_option_id')
                    ->withTimestamps();
    }

}
