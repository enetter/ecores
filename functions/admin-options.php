<?php

$options[] = array(	"name" => "Préférences de navigation et d'affichage",
					"type" => "heading");	

$options[] = array(	"name" => "Image d'entête",
					"desc" => "Saisissez ici l'URL de l'image de fond de votre entête, relative à l'url de votre blog (".site_url()."). Pr exemple : saisir '/wp-content/uploads/monlogo.jpg' si vous accédez à l'image par ".site_url()."/wp-content/uploads/monlogo.jpg.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "text");	
				
$options[] = array(	"name" => "Carousel",
					"desc" => "Les articles de cette catégorie seront affichés sur la page d'accueil dans le carousel.",
					"id" => $shortname."_cat_a_la_une",
					"std" => "",
					"type" => "select",
					"options" => $alt_categories);

$options[] = array(	"name" => "A l'affiche",
					"desc" => "Les articles de cette catégorie seront affichés dans la page d'accueil dans la section 'A l'affiche'.",
					"id" => $shortname."_cat_a_l_affiche",
					"std" => "",
					"type" => "select",
					"options" => $alt_categories);

$options[] = array(	"name" => "Nombre d'éléments à l'affiche",
					"desc" => "Choisissez le nombre d'éléments qui seront listés sur la page d'accueil dans la section à l'affiche.",
					"id" => $shortname."_nb_a_l_affiche",
					"std" => "",
					"type" => "select",
					"options" => array('3','6','9','12'));

$options[] = array(	"name" => "Liens commerciaux et analyse du trafic",
					"type" => "heading");

$options[] = array(	"name" => "Liens commerciaux",
					"desc" => "Si vous souhaitez afficher un bloc d'annonces, collez ici le code Google Adsense ou de votre service de liens commerciaux.",
					"id" => $shortname."_google_adsense",
					"type" => "textarea");
$options[] = array(	"name" => "Analyse du trafic",
					"desc" => "Collez ici le code pour Google Analytics ou pour votre autre service d'analyse.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");		

?>
