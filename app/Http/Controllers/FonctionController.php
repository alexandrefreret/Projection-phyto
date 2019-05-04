<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Fonction;
use App\Http\Resources\FonctionResource as FonctionResource;

class FonctionController extends Controller
{
    //
    public function all()
    {
    	return FonctionResource::collection(Fonction::all());
    }
}

