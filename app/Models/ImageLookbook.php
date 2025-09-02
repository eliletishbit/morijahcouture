<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageLookbook extends Model
{
    //
    protected $fillable = ['url', 'lookbook_id', 'is_principale'];

    public function lookbook()
    {
        return $this->belongsTo(Lookbook::class);
    }

    public function pointsInteractifs()
    {
        return $this->hasMany(PointInteractif::class);
    }
}
