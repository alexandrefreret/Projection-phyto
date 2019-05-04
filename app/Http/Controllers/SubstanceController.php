<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Substance;
use App\Http\Resources\SubstanceResource as SubstanceResource;

class SubstanceController extends Controller
{
    //
    public function all()
    {
    	return SubstanceResource::collection(Substance::all());
    }
}
