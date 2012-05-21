<?php
/*
Template Name: Page 2 Colonnes
*/
get_header(); ?>
<div class="page">
	<div class="container">
		<div class="row">
			<div id="content" class="span9">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="row" id="post-<?php the_ID(); ?>">
					<div class="span9">
						<?php 
						$hide_title = get_post_custom_values('hide_title');
						if ($hide_title[0]!=1) : ?>
						<div class="page-header">
							<h1 class="title"><?php the_title(); ?></h1>
						</div>
						<?php 
							endif;
							$carousel_pages = get_post_custom_values('carousel_pages');
							$pages_array = explode(",", $carousel_pages[0]);
							if(!empty($carousel_pages)) : ?>
								<?php ecs_carousel(array('post__in' => $pages_array), 9); ?>
							<?php endif; ?>
							
							<?php the_content('Lire la suite &raquo;'); ?>
						
						
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
		</div>
	</div>
</div>
<?php get_footer(); ?>
