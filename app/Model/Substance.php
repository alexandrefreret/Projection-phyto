<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Substance extends Model
{
    //
    public function produits()
    {
        return $this->belongsToMany('App\Model\Produit');
    }
}
