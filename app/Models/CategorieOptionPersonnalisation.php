<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieOptionPersonnalisation extends Model
{
    //
     protected $fillable = ['nom_categorie'];

     public function options(){
       return $this->hasMany(OptionPersonnalisation::class, 'categorie_option_personnalisation_id');
     }
}
