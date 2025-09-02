<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarteCadeau extends Model
{
    //
    protected $fillable = ['montant', 'mode_envoi', 'from', 'to', 'message', 'email_destination'];
}
