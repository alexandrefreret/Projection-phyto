<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
	//
	public function produits()
	{
	    return $this->belongsToMany('App\Model\Produit');
	    // return $this->belongsToMany('App\Model\Produit')->withPivot('id');
	}
}
