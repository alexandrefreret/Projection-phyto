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

	public function noms_commerciaux()
	{
		return $this->hasMany('App\Model\NomCommercial');
	}

	public function usages()
	{
		return $this->belongsToMany('App\Model\Usage');
	}

	public function cultures()
	{
		return $this->belongsToMany('App\Model\Culture')->withPivot('id');
	}
}
