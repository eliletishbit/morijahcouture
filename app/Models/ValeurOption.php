<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValeurOption extends Model
{
    //
 protected $fillable = [
        'option_personnalisation_id',
        'sous_option_personnalisation_id',
        'valeur',
        'image',
        'prix',
    ];

    // Relation vers option principale
    public function optionPersonnalisation()
    {
        return $this->belongsTo(OptionPersonnalisation::class);
    }

    // Relation optionnelle vers sous-option
    public function sousOption()
    {
        return $this->belongsTo(SousOptionPersonnalisation::class);
    }
}
