<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
	//
	public function cereals()
	{
		return $this->hasOne('App\Model\Cereal');
	}
}
