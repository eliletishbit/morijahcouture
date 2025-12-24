<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class ProduitImagePersonnalisee extends Pivot
{
    protected $table = 'produit_image_personnalisees';

    //
    protected $fillable = [
        'produit_id',
        'image_personnalisee_id',
        'option_personnalisation_id',
        'valeur_option_id',
        'image',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function optionPersonnalisation()
    {
        return $this->belongsTo(OptionPersonnalisation::class);
    }

    public function valeurOption()
    {
        return $this->belongsTo(ValeurOption::class);
    }

    public function imagePersonnalisee()
{
    return $this->belongsTo(ImagePersonnalisee::class, 'image_personnalisee_id');
}

}
