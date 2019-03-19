<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CerealsGroup;
use \DB;
use Helper;

class ProductController extends Controller
{
	//

	public function choose()
	{

		// Je vais chercher les groupes de cultures
		$all_groups = CerealsGroup::pluck('label', 'externid');
		
		return view('product.choose', compact('all_groups', $all_groups));
	}

	public function list(Request $request)
	{
		//Je vais chercher la campagne courante
		$client = new \GuzzleHttp\Client([
			'verify' => false,
			'exceptions' => false
		]);
		$Guzzle_request = $client->request('GET', 'https://alim.agriculture.gouv.fr/ift-api/api/campagnes/courante');

		if($Guzzle_request->getStatusCode() == 200)
		{
			$response = json_decode($Guzzle_request->getBody()->getContents());
			$campagne = $response->idMetier;
			
			//Pour chaque culture que j'ai selectionné, je vais chercher les produits
			if(!empty($request->input("cereals_group")))
			{
				$all_products = [];

				foreach ($request->input("cereals_group") as $key => $cereal) 
				{

					$Cereals = CerealsGroup::where('externid', $cereal)->first();

					$all_products[$Cereals->label] = [];
					$query = "https://alim.agriculture.gouv.fr/ift-api/api/produits?campagneIdMetier=" . $campagne . "&cultureIdMetier=" . $cereal . "&page=";
					$page = 1;
					$has_result = true;
					while ($has_result) 
					{
						$product_request = $client->request('GET', $query . $page);
						if($product_request->getStatusCode() == 200 || $product_request->getStatusCode() == 206)
						{
							$response_product = json_decode($product_request->getBody()->getContents(), true);

							$all_products[$Cereals->label] = array_merge($all_products[$Cereals->label], $response_product);

							$page++;
						}
						else
						{
							//Soit 404 ou plus de produit 
							$has_result = false;
						}
					}
				}
				return view('product.list', compact('all_products', $all_products));

			}
			else
			{
				//Pas de céreale de choisie => Redirect
				return redirect()->route('choose_product');
			}
		}
		else
		{

			//Pas de campagne en cours
			abort(404);
		}
	}


	public function importCsv()
	{
	    $file = public_path('produits.csv');

	    $Helper = new Helper();

	    echo '<pre>'; var_dump($file); echo '</pre>';

	    $customerArr = $Helper->csvToArray($file, ';');

	    for ($i = 0; $i < count($customerArr); $i ++)
	    {
	        //User::firstOrCreate($customerArr[$i]);
	    }

	    return 'Jobi done or what ever';    
	}
}
