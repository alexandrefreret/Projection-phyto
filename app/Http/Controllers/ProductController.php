<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DB;
use \App\Model\Produit;
use \App\Model\Culture;
use \App\Model\Usage;
use Helper;

class ProductController extends Controller
{
	//

	public function choose()
	{

		// Je vais chercher les groupes de cultures
		$all_groups = Culture::pluck('label', 'externid');
		
		return view('product.choose', compact('all_groups', $all_groups));
	}


	public function combinaisons()
	{
		$tab_usages = [];
		$tab_cultures = [];
		$tab_fonctions = [];

		$Mproduits = new Produit();
		$produits_usages = Produit::with('usages')->get();
		if(!empty($produits_usages))
		{
			foreach ($produits_usages as $key => $value) {
				foreach ($value->usages as $k => $val) {
					$tab_usages[$val->label][] = array(
						"id" => $value->id,
						"label" => $value->nom,
						"value" => $value->nom,
					);
				}
			}
		}

		$produits_cultures = Produit::with('cultures')->get();
		if(!empty($produits_cultures))
		{
			foreach ($produits_cultures as $key => $value) {
				foreach ($value->cultures as $k => $val) {
					$tab_cultures[$val->label][] = array(
						"id" => $value->id,
						"label" => $value->nom,
						"value" => $value->nom,
					);
				}
			}
		}

		$produits_fonctions = Produit::with('fonctions')->get();
		if(!empty($produits_fonctions))
		{
			foreach ($produits_fonctions as $key => $value) {
				foreach ($value->fonctions as $k => $val) {
					$tab_fonctions[$val->nom][] = array(
						"id" => $value->id,
						"label" => $value->nom,
						"value" => $value->nom,
					);
				}
			}
		}

		$produits_substances = Produit::with('substances')->get();
		if(!empty($produits_substances))
		{
			foreach ($produits_substances as $key => $value) {
				foreach ($value->substances as $k => $val) {
					$tab_substances[$val->nom][] = array(
						"id" => $value->id,
						"label" => $value->nom,
						"value" => $value->nom,
					);
				}
			}
		}

		return response()->json([
			'usages' => $tab_usages,
			'fonctions' => $tab_fonctions,
			'cultures' => $tab_cultures,
			'substances' => $tab_substances,
		]);
	}


	public function list(Request $request)
	{


		echo '<pre>'; var_dump($request->all()); echo '</pre>';
		






		//Je vais chercher la campagne courante
		// $client = new \GuzzleHttp\Client([
		// 	'verify' => false,
		// 	'exceptions' => false
		// ]);
		// $Guzzle_request = $client->request('GET', 'https://alim.agriculture.gouv.fr/ift-api/api/campagnes/courante');

		// if($Guzzle_request->getStatusCode() == 200)
		// {
		// 	$response = json_decode($Guzzle_request->getBody()->getContents());
		// 	$campagne = $response->idMetier;
			
		// 	//Pour chaque culture que j'ai selectionné, je vais chercher les produits
		// 	if(!empty($request->input("cereals_group")))
		// 	{
		// 		$all_products = [];

		// 		foreach ($request->input("cereals_group") as $key => $cereal) 
		// 		{

		// 			$Cereals = CerealsGroup::where('externid', $cereal)->first();

		// 			$all_products[$Cereals->label] = [];
		// 			$query = "https://alim.agriculture.gouv.fr/ift-api/api/produits?campagneIdMetier=" . $campagne . "&cultureIdMetier=" . $cereal . "&page=";
		// 			$page = 1;
		// 			$has_result = true;
		// 			while ($has_result) 
		// 			{
		// 				$product_request = $client->request('GET', $query . $page);
		// 				if($product_request->getStatusCode() == 200 || $product_request->getStatusCode() == 206)
		// 				{
		// 					$response_product = json_decode($product_request->getBody()->getContents(), true);

		// 					$all_products[$Cereals->label] = array_merge($all_products[$Cereals->label], $response_product);

		// 					$page++;
		// 				}
		// 				else
		// 				{
		// 					//Soit 404 ou plus de produit 
		// 					$has_result = false;
		// 				}
		// 			}
		// 		}
		// 		return view('product.list', compact('all_products', $all_products));

		// 	}
		// 	else
		// 	{
		// 		//Pas de céreale de choisie => Redirect
		// 		return redirect()->route('choose_product');
		// 	}
		// }
		// else
		// {

		// 	//Pas de campagne en cours
		// 	abort(404);
		// }
	}
}
