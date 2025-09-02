<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValeurOption extends Model
{
    //
    protected $fillable = ['option_personnalisation_id', 'valeur', 'image'];

    public function optionPersonnalisation()
    {
        return $this->belongsTo(OptionPersonnalisation::class);
    }
}
