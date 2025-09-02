<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiau extends Model
{
    //
    protected $fillable = ['nom', 'description'];

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
