<?php get_header(); ?>
<div class="page">
	<div id="page" class="container">
		<div class="row">
			<div id="content" class="span8">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="row" id="post-<?php the_ID(); ?>">
					<div class="span8">
						<div class="page-header">
							<h1 class="title" style="color:<?php echo $current_cat_color; ?>"><?php the_title(); ?></h1>
							<p>Publié le <?php the_time('j F Y') ?></p>
						</div>
						
						<p>
							<?php the_content('Lire la suite &raquo;'); ?>
						</p>
							<?php
					$multi_page_post = get_post_custom_values('multi-page-post');
					if (!empty($multi_page_post)) {
					$posts_array = explode(",", $multi_page_post[0]); 
					ecs_multi_page_post(get_the_ID(),$posts_array);
					} ?>
						<p>
							<br/>
						<span class="label">Tags</span>
							<?php $post_tags = wp_get_post_tags( get_the_ID() );
							foreach($post_tags as $t){
								$tag = get_tag( $t );?>
								<a class="label label-success" href="<?php echo get_tag_link( $t ) ?>"><?php echo $tag->name ?></a>
							<?php } ?>
							<span class="label pull-right"><?php comments_number('Pas de commentaires', 'Un commentaire', '% commentaires');?></span>
						</p>
						<p>
							<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
						</p>
					</div>
				</div>
				<hr>
				
				<?php comments_template(); ?>


				<?php endwhile; else: ?>
					<p>D&eacute;sol&eacute;, aucun article ne correspond &agrave; votre recherche.</p>
				<?php endif; ?>
			</div>
			<div class="span2">
				<?php get_sidebar('middle'); ?>
			</div>
			<div class="span2	">
				<?php get_sidebar('right'); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
