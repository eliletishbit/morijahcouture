<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaracteristiqueProduit extends Model
{
    //
    protected $fillable = ['categorie_id', 'type', 'valeur'];

    /**
     * Relation vers Categorie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
}
