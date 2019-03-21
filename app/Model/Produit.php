<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    //
    public function mentions()
    {
    	return $this->belongsToMany('App\Model\Mention');
    }

    public function substances()
    {
    	return $this->belongsToMany('App\Model\Substance');
    }

    public function fonctions()
    {
    	return $this->belongsToMany('App\Model\Fonction');
    }
}
