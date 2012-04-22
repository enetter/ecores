<?php get_header(); ?>
<div id="page" class="container">
	<div class="row">
		<div id="content" class="span7">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="row" id="post-<?php the_ID(); ?>">
				<div class="span7">
					<div class="page-header">
						<?php edit_post_link('Modifier', '<span class="btn pull-right">', '</span>'); ?>
						<h1 class="title"><?php the_title(); ?></h1>
					</div>
					<p>
						<?php the_content('Lire la suite &raquo;'); ?>
					</p>
					<p>
						<br/>
					<p>
						<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					</p>
				</div>
			</div>
			
			<?php /* comments_template(); // Uncomment to get templates */ ?> 


			<?php endwhile; else: ?>
				<p>D&eacute;sol&eacute;, aucun article ne correspond &agrave; votre recherche.</p>
			<?php endif; ?>
		</div>
		<div class="span3">
			<?php get_sidebar('middle-page'); ?>
		</div>
		<div class="span2">
			<?php get_sidebar('right'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
