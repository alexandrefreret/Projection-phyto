<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
	//
	public function cerealsGroup()
	{
		return $this->hasOne('App\Model\CerealsGroup');
	}
}
