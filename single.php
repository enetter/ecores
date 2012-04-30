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
						<p>Publié le <?php the_time('j F Y') ?></p>
					</div>
						
					
					<p>
						<?php the_content('Lire la suite &raquo;'); ?>
					</p>
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
		<div class="span3">
			<?php get_sidebar('middle'); ?>
		</div>
		<div class="span2	">
			<?php get_sidebar('right'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
