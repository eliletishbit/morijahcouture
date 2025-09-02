<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lookbook extends Model
{
    //
    protected $fillable = ['titre', 'sous_titre', 'description', 'statut'];

    public function images()
    {
        return $this->hasMany(ImageLookbook::class);
    }

    public function videos()
    {
        return $this->hasMany(VideoLookbook::class);
    }
}
