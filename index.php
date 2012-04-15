<?php get_header(); ?>
<div class="span9">
	<?php if(!is_paged()) { ?>
		<?php include (TEMPLATEPATH . '/carousel.php'); ?>
	<?php } ?>
	<div class="page-header">
	  <h1>Derniers articles</h1>
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
								<a href="">
									<img src="http://placehold.it/260x180" alt="">
								</a>
								<div class="caption" style="height:120px">
									<h5><?php the_title(); ?></h5>
									<?php the_excerpt(); ?>
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
	
	</div>
	<?php include (TEMPLATEPATH . '/navigation.php'); ?>
</div>

	<?php get_sidebar('right'); ?>

<?php get_footer(); ?>
