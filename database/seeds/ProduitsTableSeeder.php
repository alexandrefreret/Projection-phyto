<?php

use Illuminate\Database\Seeder;

use \App\Model\Produit;
use \App\Model\Type;
use \App\Model\Mention;
use \App\Model\NomCommercial;
use \App\Model\Substance;
use \App\Model\Fonction;
use \App\Model\Usage;
use \App\Model\Culture;
use \App\Model\Step;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ProduitsTableSeeder extends Seeder
{
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		DB::table('types')->truncate();
		DB::table('produits')->truncate();
		DB::table('mentions')->truncate();
		DB::table('mention_produit')->truncate();
		DB::table('noms_commerciaux')->truncate();
		DB::table('fonctions')->truncate();
		DB::table('fonction_produit')->truncate();
		DB::table('substances')->truncate();
		DB::table('produit_substance')->truncate();
		DB::table('culture_produit')->truncate();
		DB::table('usages')->truncate();
		DB::table('produit_usage')->truncate();
		DB::table('culture_produit_step')->truncate();
		DB::table('produit_step')->truncate();

		$file = public_path('produits.csv');

		$Helper = new Helper();

		$customerArr = $Helper->csvToArray($file, ';');

		$all_produits = [];
		$all_type = [];
		$all_usages = [];
		$all_mentions = [];
		$all_nom_commerciaux = [];
		$all_substances_actives = [];
		$all_fonctions = [];
		$all_steps = [];

		foreach ($customerArr as $key => $value) 
		{
			if(!in_array($value["type produit"], $all_type))
			{
				$type = new Type();
				$type->label = $value["type produit"];
				$type->save();

				$all_type[] = $value["type produit"];
			}

			if(!in_array($value["numero AMM"], $all_produits))
			{
				$produit = new Produit();
				$produit->numero_amm = $value["numero AMM"];
				$produit->nom = $value["nom produit"];
				$produit->titulaire = $value["titulaire"];

				$produit->date_decision = null;
				if($value["date decision"] != '')
				{
					$produit->date_decision = $Helper->date2en($value["date decision"]);
				}
				$produit->type_id = $type->id;
				$produit->save();
				
				$all_produits[] =  $value["numero AMM"];
			}

			//Je vais traiter les mentions autorisées, explode | puis enregistrement
			if($value["mentions_autorisees"] != "")
			{
				$tab_mentions = explode("|", $value["mentions_autorisees"]);
				foreach ($tab_mentions as $key_mentions => $mentions) 
				{
					$mentions = trim($mentions);
					if(!in_array($mentions, $all_mentions))
					{
						$mention = new Mention();
						$mention->label = $mentions;
						$mention->save();

						$all_mentions[] = $mentions;

						$produit->mentions()->attach($mention);
					}
					else
					{
						$bdd_mention = Mention::where('label', '=', $mentions)->first();
						$has_mention_produit = Mention::find($bdd_mention->id)->produits()->where('produits.id', '=', $produit->id)->get();
						
						if($has_mention_produit->count() == 0)
						{
							$produit->mentions()->attach($bdd_mention);
						}
					}
				}
			}


			if($value["identifiant usage"] != "")
			{
				$tab_usages = explode("*", $value["identifiant usage"]);
				
				foreach ($tab_usages as $key_usages => $usages) 
				{
					$usages = trim($usages);

					//Je regarde j'ai une culture de renseignée
					if($key_usages == 0)
					{
						$bdd_culture = Culture::where('label', '=', $usages)->first();
						if(!is_null($bdd_culture))
						{
							$has_culture_produit = Culture::find($bdd_culture->id)->produits()->where('produits.id', '=', $produit->id)->get();
							
							if($has_culture_produit->count() == 0)
							{
								$produit->cultures()->attach($bdd_culture);
							}

							$culture_produit_id =  $produit->cultures()->where('produit_id', '=', $produit->id)->where('culture_id', '=', $bdd_culture->id)->first()->pivot->id;
							$all_usages[] = $usages;
						}
						else
						{
							echo '<pre>'; var_dump("pas trouvé : " . $usages); echo '</pre>';
						}
					}


					if(!in_array($usages, $all_usages))
					{
						$usage = new Usage();
						$usage->label = $usages;
						$usage->save();

						$all_usages[] = $usages;

						$produit->usages()->attach($usage);
					}
					elseif($usages != "null")
					{
						$bdd_usage = Usage::where('label', '=', $usages)->first();
						if(isset($bdd_usage->id))
						{
							$has_usage_produit = Usage::find($bdd_usage->id)->produits()->where('produits.id', '=', $produit->id)->get();
							
							if($has_usage_produit->count() == 0)
							{
								$produit->usages()->attach($bdd_usage);
							}
						}
						
					}
				}
			}


			//Je vais traiter les nom commerciaux, explode | puis enregistrement
			if($value["seconds noms commerciaux"] != "")
			{
				$tab_nom_commerciaux = explode("|", $value["seconds noms commerciaux"]);
				foreach ($tab_nom_commerciaux as $key_nom => $value_nom_commerciaux) 
				{
					$value_nom_commerciaux = trim($value_nom_commerciaux);
					if(!in_array($value_nom_commerciaux, $all_nom_commerciaux))
					{
						$nom_commercial = new NomCommercial();
						$nom_commercial->nom = $value_nom_commerciaux;
						$nom_commercial->produit_id = $produit->id;
						$nom_commercial->save();

						$all_nom_commerciaux[] = $value_nom_commerciaux;
					}
					else
					{
						$nom_commercial = new NomCommercial();
						// $has_noms_produit = $produit->noms_commerciaux()->where('produit_id', $produit->id)->where('nom', $value_nom_commerciaux)->get();
						$has_noms_produit = $produit->noms_commerciaux()->where([
							['produit_id', $produit->id],
							['noms_commerciaux.nom', $value_nom_commerciaux],
						])->get();


						
						if($has_noms_produit->count() == 0)
						{
							$nom_commercial->nom = $value_nom_commerciaux;
							$nom_commercial->produit_id = $produit->id;
							$nom_commercial->save();

							$all_nom_commerciaux[] = $value_nom_commerciaux;
						}
					}
				}
			}

			//Je vais traiter les nom commerciaux, explode | puis enregistrement
			if($value["Substances actives"] != "")
			{
				$tab_substances_actives = explode("|", $value["Substances actives"]);
				foreach ($tab_substances_actives as $key_substance => $value_substance) 
				{
					$value_substance = trim($value_substance);
					if(!in_array($value_substance, $all_substances_actives))
					{
						$substance = new Substance();
						$substance->nom = $value_substance;
						$substance->save();

						$all_substances_actives[] = $value_substance;

						$produit->substances()->attach($substance);
					}
					else
					{
						$bdd_substances = Substance::where('nom', '=', $value_substance)->first();
						$has_substances_produit = Substance::find($bdd_substances->id)->produits()->where('produits.id', '=', $produit->id)->get();
						
						if($has_substances_produit->count() == 0)
						{
							$produit->substances()->attach($bdd_substances);
						}
					}
				}
			}


			if($value["fonctions"] != "")
			{
				$tab_fonctions = explode("|", $value["fonctions"]);
				foreach ($tab_fonctions as $key_fonction => $value_fonction) 
				{
					$value_fonction = trim($value_fonction);
					if(!in_array($value_fonction, $all_fonctions))
					{
						$fonction = new Fonction();
						$fonction->nom = $value_fonction;
						$fonction->save();

						$all_fonctions[] = $value_fonction;

						$produit->fonctions()->attach($fonction);
					}
					else
					{
						$bdd_fonctions = Fonction::where('nom', '=', $value_fonction)->first();
						$has_fonctions_produit = Fonction::find($bdd_fonctions->id)->produits()->where('produits.id', '=', $produit->id)->get();
						
						if($has_fonctions_produit->count() == 0)
						{
							$produit->fonctions()->attach($bdd_fonctions);
						}
					}
				}
			}


			//Je vais créer un tableau avec toutes variables combinées car je dois distinguer les produits
			$str = $value["numero AMM"] . ";" . $value["stade cultural min"] . ";" . $value["stade cultural max"] . ";" . $value["etat usage"] . ";" . $value["dose retenue"] . ";" . $value["dose retenue unite"] . ";" . $value["delai avant recolte jour"] . ";" . $value["delai avant recolte bbch"] . ";" . $value["nombre max d'application"] . ";" . $value["date fin distribution"] . ";" . $value["date fin utilisation"] . ";" . $value["condition emploi"] . ";" . $value["ZNT aquatique (en m)"] . ";" . $value["ZNT arthropodes non cibles (en m)"] . ";" . $value["ZNT plantes non cibles (en m)"];

			if(!in_array($str, $all_steps))
			{

				$all_steps[] = $str;

				$step = DB::select( DB::raw("SELECT *
				          FROM produit_step 
				          WHERE produit_id = '". $produit->id ."'"));
				if(empty($step))
				{
					if($value["stade cultural min"] == "")
					{
						 $value["stade cultural min"] = 0;
					}
					if($value["stade cultural max"] == "")
					{
						 $value["stade cultural max"] = 0;
					}
					DB::insert( 'INSERT INTO produit_step (produit_id, step_min, step_max) VALUES (?,?,?)', [$produit->id, $value["stade cultural min"], $value['stade cultural max']] );
					$produit_step_id = DB::getPdo()->lastInsertId();
				}

				$date_distrib = explode("/", $value["date fin distribution"]);
				$date_distrib = $date_distrib[2] . "-" . $date_distrib[1] . "-" . $date_distrib[0];

				$date_utilisation = explode("/", $value["date fin utilisation"]);
				$date_utilisation = $date_utilisation[2] . "-" . $date_utilisation[1] . "-" . $date_utilisation[0];
				
				DB::table('culture_produit_step')->insert([
					'produit_step_id' => $produit_step_id,
					'delai' => $value["delai avant recolte jour"],
					'delai_bbch' => $value["delai avant recolte bbch"],
					'dose' => $value["dose retenue"],
					'dose_unite' => $value["dose retenue unite"],
					'nb_application_max' => $value["nombre max d'application"],
					'etat' => $value["etat usage"],
					'date_fin_distribution' => $date_distrib,
					'date_fin_utilisation' => $date_utilisation,
					'condition_emploi' => $value["condition emploi"],
					'znt_aquatique' => $value["ZNT aquatique (en m)"],
					'znt_arthropodes' => $value["ZNT arthropodes non cibles (en m)"],
					'znt_plantes' => $value["ZNT plantes non cibles (en m)"],
				]);

			}

			if($key == 100)
			{
				die();
			}
		}
	}
}
