<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoLookbook extends Model
{
    //
    protected $fillable = ['url', 'lookbook_id'];

    public function lookbook()
    {
        return $this->belongsTo(Lookbook::class);
    }
}
