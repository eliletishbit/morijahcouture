<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogueEchantillon extends Model
{
    //
    protected $fillable = ['nom', 'description', 'image'];

    public function echantillons()
    {
        return $this->hasMany(Echantillon::class);
    }
}
