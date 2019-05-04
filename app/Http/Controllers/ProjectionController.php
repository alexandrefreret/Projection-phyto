<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectionController extends Controller
{
    //
    public function index()
    {
		return view('projection.index');
    }
}
