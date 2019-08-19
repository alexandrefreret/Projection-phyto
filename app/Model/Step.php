<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
	//
	public function produit()
	{
		return $this->hasOne('App\Model\produit');
	}
}
