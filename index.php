<?php get_header(); ?>
<div class="span9">
	<?php if(!is_paged()) { ?>
		<?php include (TEMPLATEPATH . '/carousel.php'); ?>
	<?php } ?>
	<div class="page-header">
	  <h1>A l'affiche</h1>
	</div>
	<div class="span9">
			<?php
			$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
			query_posts("cat=".get_option('ecs_cat_a_l_affiche')."&paged=$page&posts_per_page=.get_option('posts_per_page')"); ?>
			<?php $nbposts=0; ?>
			<?php while (have_posts()) : the_post(); ?>

			<?php if ($nbposts % 3 == 0) { ?>
				<div class="row">
					<ul class="thumbnails">
						<?php } ?>
						<li class="span3">
							<div class="thumbnail">
								<a href="<?php the_permalink() ?>">
									<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=260&h=180&zc=1&q=100">
								</a>
								<div class="caption" style="height:50px">
									<h4><?php the_title(); ?></h4>
									<p>
										<span class="label"><?php the_time('j/m/Y') ?></span> 
										<span class="label"><?php comments_number('Pas de commentaires', 'Un commentaire', '% commentaires');?></span>
									</p>
								</div>
							</div>
						</li>
						<?php if ($nbposts % 3 == 2) { ?>
					</ul>
				</div>
			<?php } ?>
			<?php if ($nbposts == 5) { break; }?>
			<?php $nbposts=$nbposts+1 ?>
		<?php endwhile; ?>
		<?php  if ($nbposts-1 % 3 != 2) {echo "</ul></div>"; } ?>	
	</div>
	<?php include (TEMPLATEPATH . '/navigation.php'); ?>
</div>

	<?php get_sidebar('right'); ?>

<?php get_footer(); ?>
