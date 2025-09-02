<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeLivraison extends Model
{
    //
    protected $fillable = ['nom', 'delai_estime', 'cout'];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
