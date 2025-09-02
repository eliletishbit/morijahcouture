<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionPersonnalisation extends Model
{
    //
    protected $fillable = ['produit_id', 'nom_option', 'type_option'];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function valeurOptions()
    {
        return $this->hasMany(ValeurOption::class);
    }
}
