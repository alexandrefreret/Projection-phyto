<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NomCommercial extends Model
{
	public $table = "noms_commerciaux";
	//
	public function produits()
	{
		return $this->hasMany('App\Model\Produit');
	}
}
