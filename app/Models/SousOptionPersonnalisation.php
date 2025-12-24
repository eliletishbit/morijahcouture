<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousOptionPersonnalisation extends Model
{
    //
    protected $fillable = ['option_personnalisation_id', 'nom_sous_option'];

    // Relation vers option parente
    public function option()
    {
        return $this->belongsTo(OptionPersonnalisation::class);
    }

    // Valeurs liées à la sous-option
    public function valeurs()
    {
        return $this->hasMany(ValeurOption::class);
    }
}

