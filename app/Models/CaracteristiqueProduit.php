<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaracteristiqueProduit extends Model
{
    //
    protected $fillable = ['produit_id', 'type', 'valeur'];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
