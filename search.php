<?php get_header(); ?>
<div id="page" class="container">
	<div class="row">
	<div id="content" class="span8">

	<?php if (have_posts()) : ?>
	<div class="page-header">
	<h1>R&eacute;sultats de la recherche</h2>
	</div>

	<div id="archive">	

	<?php while (have_posts()) : the_post(); ?>

		<?php include (TEMPLATEPATH . '/list_post.php'); ?>	
	<?php endwhile; ?>

	<?php include (TEMPLATEPATH . '/navigation.php'); ?>

	</div>

	<?php else : ?>
	

	<span class="breadcrumbs"><a href="<?php echo get_option('home'); ?>/">Accueil</a> &raquo; Pas de correspondances</span>
	<h2 class="title">Aucun article trouvé. Essayez une autre recherche !</h2>
	

	<?php endif; ?>

	</div>


<div class="span2">
	<?php get_sidebar('middle-archive'); ?>
</div>
<div class="span2">
  <?php get_sidebar('right'); ?>
</div>

</div>
</div>
<?php get_footer(); ?>
