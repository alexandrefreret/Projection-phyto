<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CerealsGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('cereals_group')->truncate();

    	//Je vais appeler l'api
    	$url_api = "https://alim.agriculture.gouv.fr/ift-api/api/cultures";
    	$content = file_get_contents($url_api);
    	$json = json_decode($content, true);

    	if(!empty($json))
    	{
    		foreach ($json as $key => $value) 
    		{
    			DB::table('cereals_group')->insert([
    				"label" => $value["libelle"],
    				"externid" => $value["idMetier"],
    			]);
    		}
    	}
    }
}
