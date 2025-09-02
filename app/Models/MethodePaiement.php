<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MethodePaiement extends Model
{
    //
     protected $fillable = ['nom'];

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
