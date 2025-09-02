<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointInteractif extends Model
{
    //
    protected $fillable = ['image_lookbook_id', 'position_x', 'position_y', 'produit_id', 'description_popup'];

    public function imageLookbook()
    {
        return $this->belongsTo(ImageLookbook::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
