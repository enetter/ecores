<?php

// THIS IS THE DIFFERENT FIELDS
$options[] = array(	"name" => "Préférences générales",
					"type" => "heading");
						
$options[] = array(	"name" => "Feuille de style",
					"desc" => "Choisissez ici le style de votre thème.",
					"id" => $shortname."_stylesheet",
					"std" => "",
					"type" => "select",
					"options" => $alt_stylesheets);

$options[] = array(	"name" => "Image d'entête",
					"desc" => "Saisissez ici l'URL de l'image de fond de votre entête.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "text");	

$options[] = array(	"name" => "Google Analytics",
					"desc" => "Collez ici le code pour Google Analytics ou pour votre autre service d'analyse.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");		

$options[] = array(	"name" => "Préférences de navigation et d'affichage",
					"type" => "heading");	
				
$options[] = array(	"name" => "Catégorie 'A la une'",
					"desc" => "Saisissez l'identifiant de la catégorie 'A la une' (par exemple 3).",
					"id" => $shortname."_cat_a_la_une",
					"std" => "",
					"type" => "text");

$options[] = array(	"name" => "Catégorie 'A l'affiche'",
					"desc" => "Saisissez l'identifiant de la catégorie 'A l'affiche' (par exemple 4).",
					"id" => $shortname."_cat_a_l_affiche",
					"std" => "",
					"type" => "text");

$options[] = array(	"name" => "Catégories à exclure",
					"desc" => "Saisissez une liste d'identfiant de catégories à exclure de la barre des catégories - à minima les catégories 'à la une' et 'à l'affiche'. (par exemple : 1,2,3,4)",
					"id" => $shortname."_menucat",
					"std" => "",
					"type" => "text");
$options[] = array(	"name" => "Pages à exclure",
					"desc" => "Saisissez une liste d'identifiant de pages que vous souhaitez exclure de la barre de navigation des pages. (par exemple : 1,2,3,4)",
					"id" => $shortname."_menupages",
					"std" => "",
					"type" => "text");

$options[] = array(	"name" => "Liens commerciaux",
					"type" => "heading");

$options[] = array(	"name" => "Google Adsense",
					"desc" => "Si vous souhaitez afficher un bloc d'annonces, collez ici le code Google Adsense.",
					"id" => $shortname."_google_adsense",
					"type" => "textarea");

?>
