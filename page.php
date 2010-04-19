<?php get_header(); ?>

	<div id="content">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
	<div class="post" id="post_<?php the_ID(); ?>">

	<span class="breadcrumbs"><a href="<?php echo get_option('home'); ?>/">Accueil</a> &raquo; <?php the_title(); ?></span>
		
	<h2 class="title"><?php the_title(); ?></h2>
		
		<div class="entry clearfloat">
		<?php the_content('<p class="serif">Lire la suite &raquo;</p>'); ?>

		<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		</div>
		
	<?php edit_post_link('Modifier cette page.', '<p>', '</p>'); ?>

	</div>
	<div><p><?php the_tags(); ?></p></div>
		
	<div id="comments">
	<?php comments_template(); ?>
	</div>

	<?php endwhile; endif; ?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
