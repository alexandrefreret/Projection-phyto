<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ProduitsTableSeeder extends Seeder
{
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		DB::table('produits')->truncate();

		$file = public_path('produits.csv');

	    $Helper = new Helper();

	    $customerArr = $Helper->csvToArray($file, ';');

	    foreach ($customerArr as $key => $value) 
	    {
	    	echo '<pre>'; var_dump($value); echo '</pre>';
	    	die();
	    }
	}
}
