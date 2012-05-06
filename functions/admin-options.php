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

$options[] = array(	"name" => "Navigation par menu ou catégories",
					"desc" => "Souahitez-vous que la navigation soit gérée par un menu Wordpress ou par la liste des catégories ?",
					"id" => $shortname."_menu_or_cats_nav",
					"std" => "0",
					"type" => "radio",
					"options" => array('Menu', 'Catégories'));

$options[] = array(	"name" => "A l'affiche",
					"type" => "heading");

$options[] = array(	"name" => "Articles ou Catégories",
					"desc" => "Souhaitez-vous afficher les articles ou les catégories à l'affiche ?",
					"id" => $shortname."_cats_or_posts_a_l_affiche",
					"std" => "0",
					"type" => "radio",
					"options" => array('Articles en liste', 'Articles en images', 'Catégories 2 colonnes', 'Catégories 4 colonnes'));

$options[] = array(	"name" => "Articles à l'affiche",
					"desc" => "Si vous avez choisi d'afficher les Articles, ce sont ceux de cette catégorie seront affichés dans la page d'accueil dans la section 'A l'affiche'.",
					"id" => $shortname."_cat_a_l_affiche",
					"std" => "",
					"type" => "select",
					"options" => $alt_categories);

$options[] = array(	"name" => "Catégories à l'affiche",
					"desc" => "Si vous avez choisi d'afficher les Catégories par 4, ce sont les 4 premières sélectionnées ci-dessous qui seront affichées dans la page d'accueil.",
					"id" => $shortname."_cats_a_l_affiche",
					"std" => "-1",
					"type" => "multicheck",
					"options" => $alt_categories);

$options[] = array(	"name" => "Nombre d'articles à l'affiche",
					"desc" => "Choisissez le nombre d'articles qui seront listés dans la section à l'affiche ou dans chaque catégorie à l'affiche.",
					"id" => $shortname."_nb_a_l_affiche",
					"std" => "",
					"type" => "select",
					"options" => array('2','4','6','8','10','12'));

$options[] = array(	"name" => "Analyse du trafic",
					"type" => "heading");

$options[] = array(	"name" => "Analyse du trafic",
					"desc" => "Collez ici le code pour Google Analytics ou pour votre autre service d'analyse.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");		

?>
