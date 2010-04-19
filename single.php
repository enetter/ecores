<?php get_header(); ?>

	<div id="content">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
	
	<span class="breadcrumbs"><a href="<?php echo get_option('home'); ?>/">Accueil</a> &raquo; <?php the_category(', ') ?></span>
	
	<h2 class="title"><?php the_title(); ?></h2>
	
	<div id="stats">
<span><?php the_time('j F Y') ?></span>

<span><?php comments_number('Pas de commentaires', 'Un commentaire', '% commentaires');?></span>
<?php edit_post_link('Modifier cet article.', '<span>', '</span>'); ?>
</div>


	<div class="entry clearfloat">
	
	<?php the_content('Lire la suite &raquo;'); ?>

	<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	
	</div>
	<div class="entry clearfloat">
		<div class="breadcrumbs"><p><?php the_tags('Tags : ',', '); ?></p></div>
	</div>
	<div id="tools">
		<div style="float:right;display:block;"><?php if(function_exists('the_ratings')) { the_ratings(); } ?></div>	
	</div>

	</div>
	
	<div id="comments">
	<?php comments_template(); ?>
	</div>

	<?php endwhile; else: ?>

	<p>D&eacute;sol&eacute;, aucun article ne correspond &agrave; votre recherche.</p>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
