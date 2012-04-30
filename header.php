<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


	<link rel="icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
	<?php wp_head(); ?>
	<style><?php //echo category_color_css(); 
							 	echo menu_color_css('main'); 
	?></style>
</head>
<body>
	<div class="hero-unit header" style="background-image:url('<?php
		if (get_option('ecs_logo')=='') {
			echo bloginfo('template_directory').'/images/logo.png';
		} else {
			echo bloginfo('wpurl').get_option('ecs_logo');
		}
	?>')">
		<div class="container">
		<h1><?php bloginfo('title'); ?></h1>
		<p ><?php bloginfo('description'); ?></p>
		</div>
	</div>
	<?php if (get_option('ecs_menu_or_cats_nav')==0) : // Menu navigation ?>
			<?php ecs_nav_menu('main'); ?>
	<?php else : // Categories navigation ?>
		<?php include (TEMPLATEPATH . '/menu_categories.php'); ?>	
	<?php endif; ?>
  <div style="margin-bottom:18px">
  	<?php //the_menu_items('main') ; ?>
  </div>


		
