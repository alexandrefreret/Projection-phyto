<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CerealsGroup;
use \DB;

class StepController extends Controller
{
    //

    public function add()
    {
    	$all_groups = CerealsGroup::pluck('label', 'id');
    	
    	return view('step.add', compact('all_groups', $all_groups));
    }


    public function save(Request $request)
    {
    	$groupe = $request->input("cereals_group");

    	if(!empty($groupe))
    	{
    		foreach ($groupe as $key => $value) 
    		{
    			DB::table("step")->insert([
    				"label" => $request->input("label"),
    				"min" => $request->input("min"),
    				"min" => $request->input("min"),
    				"max" => $request->input("max"),
    				"cereals_group" => $value,
    			]);
    		}
    	}

    }
}
