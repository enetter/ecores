<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : ?>
	
	<span class="breadcrumbs"><a href="<?php echo get_option('home'); ?>/">Accueil</a> &raquo; Recherche</span>

	<h2 class="title">R&eacute;sultats de la recherche</h2>

	<div id="archive">	

	<?php while (have_posts()) : the_post(); ?>

	<div class="clearfloat">
	<h3 class="cat_title"><?php the_category(', '); ?> &raquo;</h3>
	<div class="title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></div>
	<div class="meta">[<?php the_time('j M Y') ?> | <?php comments_popup_link('Pas de commentaires', 'Un commentaire', '% commentaires');?> | <?php if(function_exists('the_views')) { the_views(); } ?>]</div>	
	
	<div class="spoiler">
	<?php	$values = get_post_custom_values("Image");
	if (isset($values[0])) { ?>
      <a href="<?php the_permalink() ?>" rel="bookmark" title="Lien permanent vers <?php the_title(); ?>">
	<img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php
$values = get_post_custom_values("Image"); echo $values[0]; ?>&w=150&h=150&zc=1&q=100"
alt="<?php the_title(); ?>" class="left" width="150px" height="150px"  /></a>
      <?php } ?>

	<?php the_excerpt(); ?>
	</div>

	</div>

		
<?php endwhile; ?>

		<div class="navigation">
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } 
			else { ?>

			<div class="right"><?php next_posts_link('Page suivante &raquo;') ?></div>
			<div class="left"><?php previous_posts_link('&laquo; Page pr&eacute;c&eacute;dente') ?></div>
			<?php } ?>

		</div>

	</div>

	<?php else : ?>
	

	<span class="breadcrumbs"><a href="<?php echo get_option('home'); ?>/">Accueil</a> &raquo; Pas de correspondances</span>
	<h2 class="title">Aucun article trouvé. Essayez une autre recherche !</h2>
	

	<?php endif; ?>

	</div>




<?php get_sidebar(); ?>
<?php get_footer(); ?>
