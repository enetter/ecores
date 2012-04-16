<?php get_header(); ?>
<div id="page" class="container">
	<div class="row">

	<div id="content" class="span9">
	
	<?php if (have_posts()) : ?>
	
	
 	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	<div class="page-header">
	 	<?php /* If this is a category archive */ if (is_category()) { ?><h1><?php single_cat_title(); ?></h1Ò>

		<?php /* If this is a tagged archive */ } elseif (is_tag()) { ?>	<h1>Articles marqu&eacute;s comme : <?php single_tag_title(); ?></h2>

	 	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>	<h2 class="title">Articles du jour : <?php the_time('j F Y'); ?></h2>

	 	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?><h2 class="title">Articles du mois : <?php the_time('F Y'); ?></h2>
	 	
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="title">Articles de l'ann&eacute; : <?php the_time('Y'); ?></h2>

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

<?php get_sidebar('right'); ?>

</div>
</div>
<?php get_footer(); ?>
