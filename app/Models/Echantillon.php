<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Echantillon extends Model
{
    //
    protected $fillable = ['nom', 'type', 'image', 'catalogue_id'];

    public function catalogue()
    {
        return $this->belongsTo(CatalogueEchantillon::class);
    }
}
