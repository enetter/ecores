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
		<div class="navbar">
			<div class="navbar-inner">
					<div class="container">
						<?php wp_nav_menu(array('theme_location' => 'main' ,'container' => 'div', 'container_class' => 'nav-collapse','menu_class' =>'nav', 'walker' => new ecs_menu_walker() )); ?>
						<ul class="nav pull-right">
							<?php include (TEMPLATEPATH . '/searchform.php'); ?>
						</ul>
					</div>
				</div>
		</div>
	<?php else : // Categories navigation?>
		<div class="navbar">
			<div class="navbar-inner">
					<div class="container">
						<ul class="nav">
							<li class="<?php if (is_home()) { echo 'current-cat'; } ?>">
								<a href="<?php bloginfo('url');?>"><i class="icon-home icon-white"></i> Accueil</a>
							</li>
						<?php 
							$args = array(
								'exclude' => get_option('ecs_cat_a_la_une').','.get_option('ecs_cat_a_l_affiche'), 
								'title_li' => '', 
						    'echo' => 1,
						    'depth' => 1, ); 
						  wp_list_categories( $args );?>
						</ul>
						<ul class="nav pull-right">
							<?php include (TEMPLATEPATH . '/searchform.php'); ?>
						</ul>
					</div>
				</div>
		</div>
		<?php if (!is_home()) : ?>
			<div class="subnav subnav-fixed">
				<div class="container">
					<ul class="nav nav-pills">
			    <?php
			    	$cat_id = get_query_var('cat');
			    	$children = get_category_children($cat_id);
			    	if ($children =='') {
			    		$cat = get_category($cat_id);
			    		$cat_id = $cat->parent;
			    	}
						$args = array(
									'exclude' => get_option('ecs_cat_a_la_une').','.get_option('ecs_cat_a_l_affiche'), 
									'title_li' => '', 
									'child_of' => $cat_id,
							    'echo' => 1,
							    'depth' => 1, ); 
						wp_list_categories( $args );?>
					</ul>
				</div>
		  </div>
		<?php endif; ?>
	<?php endif; ?>
  <div style="margin-bottom:18px">
  </div>


		
