<?php get_header(); ?>
<div class="page">
	<div class="container">
		<div class="row">

		<div id="content" class="span8">
		
		<?php if (have_posts()) : ?>
		
		
	 	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	 	<div class="page-header">
		 	<?php /* If this is a category archive */ 
		 			if (is_category()) { 
		 				$cat_id = get_query_var('cat');
		 				$cat = get_category($cat_id);
		 				$output = $cat->name;
		 				if($cat->parent) {
		 					$parent = get_category($cat->parent);
		 					$output = $parent->name . ' / '. $output;
		 				}


		 		?><h1 style="color:<?php echo $current_cat_color; ?>"><?php echo $output ;?></h1>

			<?php /* If this is a tagged archive */ } elseif (is_tag()) { ?>	<h1>Articles marqu&eacute;s comme : <?php single_tag_title(); ?></h2>

		 	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>	<h1>Articles du jour : <?php the_time('j F Y'); ?></h1>

		 	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?><h1>Articles du mois : <?php the_time('F Y'); ?></h1>
		 	
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h1>Articles de l'ann&eacute; : <?php the_time('Y'); ?></h1>

		 	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2 class="title">Archives</h2>
	 	 <?php } ?>
	 	
	 	</div>	
			
	 	<?php while (have_posts()) : the_post(); ?>	
	 			<?php include (TEMPLATEPATH . '/list_post.php'); ?>
	 	<?php endwhile; ?>

	 	<?php include (TEMPLATEPATH . '/navigation.php'); ?>
		
		
		<?php else : ?>
		
		<h2 class="title">Aucun article trouv&eacute;. Essayez une recherche diff&eacute;rente ?</h2>
		
		<?php endif; ?>
		
		</div>
		<?php 
  		$option = get_option('ecs_col_centre_or_right');
		?>  
		<div class="span2">
		  <?php  if ($option==0) { get_sidebar('middle-archive');} else {get_sidebar('right');} ?>
		</div>
		<div class="span2">
		  <?php  if ($option==0) { get_sidebar('right');} else {get_sidebar('middle-archive');} ?>
		</div>

	</div>
	</div>
</div>
<?php get_footer(); ?>
