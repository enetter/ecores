<?php get_header(); ?>
<div id="page" class="container">
	<div class="row">
		<div id="content" class="span8">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="row" id="post-<?php the_ID(); ?>">
				<div class="span8">
					
					<?php 
					$hide_title = get_post_custom_values('hide_title');
					if ($hide_title[0]!=1) : ?>
					<div class="page-header">
						<?php edit_post_link('Modifier', '<span class="btn pull-right">', '</span>'); ?>
						<h1 class="title"><?php the_title(); ?></h1>
					</div>
					<?php 
						endif;
						$carousel_pages = get_post_custom_values('carousel_pages');
						$pages_array = explode(",", $carousel_pages[0]);
						if(!empty($pages_array)) : ?>
							<?php ecs_carousel(array('post_type' => 'page', 'post__in' => $pages_array)); ?>
						<?php endif; ?>
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
		<div class="span2">
			<?php get_sidebar('middle-page'); ?>
		</div>
		<div class="span2">
			<?php get_sidebar('right'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
