<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProduitOptionValeur extends Pivot
{
    //
     // Nom explicite de la table pivot
    protected $table = 'produit_option_valeur';

    // Colonnes assignables (fillable)
    protected $fillable = [
        'produit_id',
        'option_personnalisation_id',
        'valeur_option_id',
    ];

    public function optionPersonnalisation()
    {
        return $this->belongsTo(OptionPersonnalisation::class, 'option_personnalisation_id');
    }

    public function valeurOption()
    {
        return $this->belongsTo(ValeurOption::class, 'valeur_option_id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
