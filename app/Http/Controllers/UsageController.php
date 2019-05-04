<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Usage;
use App\Http\Resources\UsageResource as UsageResource;

class UsageController extends Controller
{
    //
    public function all()
    {
    	return UsageResource::collection(Usage::all());
    }
}
