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
	<div class="navbar">
		<div class="navbar-inner">
				<div class="container">
				<div class="nav-collapse">
				<ul class="nav">
					<li <?php if (is_home()) echo 'class="active"'; ?>><a href="<?php echo get_option('home'); ?>/"><i class="icon-home icon-white"></i> Accueil</a></li>
					 <?php 
  					$args ='parent=0&exclude='.get_option('ecs_cat_a_l_affiche').','.get_option('ecs_cat_a_la_une').'&orderby=name';
					 	$categories = get_categories($args); 
					  foreach ($categories as $category) { ?>
						 	<li class="dropdown" id="menu<?php echo $category->term_id ?>">
						    <a class="dropdown-toggle" data-toggle="dropdown" href="#menu<?php echo $category->term_id ?>">
						      <?php echo $category->name ?>
						      <b class="caret"></b>
						    </a>
						    <ul class="dropdown-menu">
						    	<?php 
						    		$childnb = count(get_term_children( $category->term_id, 'category' ));
						    		$allcats = get_categories();
						    		foreach ($allcats as $subcat) { ?>
						    			<?php if ($subcat->parent == $category->term_id) { ?>
						    				<li><a href="<?php echo esc_url(get_category_link($subcat->term_id)); ?>"><?php echo $subcat->name ?></a></li>
						    			<?php }	?>
						    		<?php } ?>
						    </ul>
						  </li>
					 <?php } ?>
					 </ul>
					
					
					<ul class="nav pull-right">
					 	<li class="dropdown" id="menupages">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#menupages">
					      Infos
					      <b class="caret"></b>
					    </a>
					    <ul class="dropdown-menu">
					    	<?php 
					    		$args = 'parent='.$category->term_id.'hierarchical=false';
					    		$pages = get_pages();
					    		foreach ($pages as $page) { ?>
					    		 	<li><a href="<?php echo esc_url(get_permalink($page->ID)); ?>"><?php echo $page->post_title ?></a></li>
					    		<?php } ?>
					    </ul>
					  </li>
					<?php include (TEMPLATEPATH . '/searchform.php'); ?>
					
				</ul>
			</div>
		</div>
		</div>
	</div>

		
