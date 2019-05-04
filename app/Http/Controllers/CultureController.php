<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Culture;
use App\Http\Resources\CultureResource as CultureResource;
use Illuminate\Support\Facades\Cache;

class CultureController extends Controller
{
	//
	public function all()
	{
		// $cultures = Cache::remember('cultures', 22*60, function() {
			return CultureResource::collection(Culture::all());
		// });
		
		// return CultureResource::collection($cultures);
	}

}
