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
	<?php else : // Categories navigation ?>
		<div class="navbar">
			<div class="navbar-inner">
					<div class="container">
						<ul class="nav">
							<li class="<?php if (is_home()) { echo 'current-cat'; } ?>">
								<a href="<?php bloginfo('url');?>"><i class="icon-home icon-white"></i> Accueil</a>
							</li>
							<?php 
							// Do we display the subnavigation ?
							$is_navigable = (is_category() || is_single());
							// Loop through all first level categories
							$args = array(
								'type'                     => 'post',
								'child_of'                 => '',
								'parent'                   => 0,
								'orderby'                  => 'name',
								'order'                    => 'ASC',
								'hide_empty'               => 1,
								'hierarchical'             => 1,
								'exclude'                  => get_option('ecs_cat_a_la_une').','.get_option('ecs_cat_a_l_affiche'),
								'include'                  => '',
								'number'                   => '',
								'taxonomy'                 => 'category',
								'pad_counts'               => false );
							$categories = get_categories($args);
							foreach ($categories as $key => $cat) {
								$category_url = get_category_link( $cat->term_id );
								$category_name = $cat->name;
								
								if (is_single()) {
									$post_categories = get_the_category();
									$selected = in_array($cat, $post_categories);
									// Search for first top level cat of post, and store it
									foreach ($post_categories as $key => $post_cat) {
										if ($cat->term_id == $post_cat->term_id) {
											if (empty($single_root_cat)) {
												$selected = true;
												$single_root_cat = $cat ;
											}
											break;
										}
									}
								}
								else
								{ 
									// See if the current cat or one of its children is selected
									$category_children = explode(',',get_category_children_id($cat->cat_ID));
									$selected = ($is_navigable && (get_query_var('cat')==$cat->term_id || in_array(get_query_var('cat'),$category_children)) && !is_home());
								}	?>
						  	<li <?php echo ($selected) ? 'class="current-cat"' : ''; ?>>
						  		<a href="<?php echo esc_url($category_url); ?>"><?php echo $category_name; ?></a>
						  	</li>
					  		<?php } ?>
						</ul>
						<ul class="nav pull-right">
							<?php include (TEMPLATEPATH . '/searchform.php'); ?>
						</ul>
					</div>
				</div>
		</div>
		<?php if (!is_home() && $is_navigable) : 
			if (is_single()) {
    		$cat_id = $single_root_cat->term_id;
    	}
    	else
    	{	
    		$cat_id = get_query_var('cat');
    	}
    	$children = get_category_children($cat_id);
    	if ($children =='') {
    		$cat = get_category($cat_id);
    		$cat_id = $cat->parent;
    	}
			$args = array( 'parent' => $cat_id );
			$parent = get_category($cat_id);
			global $cat_color;
			$cat_color = $parent->description;
			?>
			<div class="subnav subnav-fixed" >
				<div class="container">
					<ul class="nav nav-pills">
			    <?php
						$categories = get_categories($args);
						foreach ($categories as $key => $cat) { 
							$category_url = get_category_link( $cat->term_id );
							$category_name = $cat->name; 
							$selected = false;
							if (is_single()) {
									$post_categories = get_the_category();
									foreach ($post_categories as $key => $post_cat) {
										if ($cat->term_id == $post_cat->term_id) {
											$selected = true;
											break;
										}
									}
								}
								else
								{
									$selected = (get_query_var('cat')==$cat->term_id);
								}

							?>
							<li <?php echo ($selected) ? 'class="current-cat"' : ''; ?>>
						  		<a href="<?php echo esc_url($category_url); ?>"><?php echo $category_name; ?></a>
						  </li>
						<?php } ?>
						
					</ul>
				</div>
		  </div>
		<?php endif; ?>
	<?php endif; ?>
  <div style="margin-bottom:18px">
  	<?php //print_r(get_the_category()) ; ?>
  </div>


		
