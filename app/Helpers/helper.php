<?php 

namespace App\Helpers;
Use \Route;
class Helper
{
	/*
	|--------------------------------------------------------------------------
	| Detect Active Route
	|--------------------------------------------------------------------------
	|
	| Compare given route with current route and return output if they match.
	| Very useful for navigation, marking if the link is active.
	|
	*/
	function isActiveRoute($route, $output = "active")
	{
	    if (Route::currentRouteName() == $route) return $output;
	}

	/*
	|--------------------------------------------------------------------------
	| Detect Active Routes
	|--------------------------------------------------------------------------
	|
	| Compare given routes with current route and return output if they match.
	| Very useful for navigation, marking if the link is active.
	|
	*/
	function areActiveRoutes(Array $routes, $output = "active")
	{
	    foreach ($routes as $route)
	    {
	        if (Route::currentRouteName() == $route) return $output;
	    }

	}

	/*
	|--------------------------------------------------------------------------
	| Convert csv files to array
	|--------------------------------------------------------------------------
	|
	| Pass csv files to recover an array with header in key 
	|
	*/
	function csvToArray($filename = '', $delimiter = ',')
	{
	    if (!file_exists($filename) || !is_readable($filename))
	        return false;

	    $header = null;
	    $data = array();
	    if (($handle = fopen($filename, 'r')) !== false)
	    {
	        while (($row = fgetcsv($handle, 0, $delimiter)) !== false)
	        {
	            if (!$header)
	                $header = $row;
	            else
	                $data[] = array_combine($header, $row);
	        }
	        fclose($handle);
	    }

	    return $data;
	}
}