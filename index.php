<?php get_header(); ?>
<div id="page" class="container">
	<div class="row">
		<div class="span6">
				<?php include (TEMPLATEPATH . '/carousel.php'); ?>
		</div>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : /* Widgetized sidebar, if you have the plugin installed. */ 	?>
			<?php endif; ?>
	</div>
	<div class="row">

		<?php 
			if (get_option('ecs_cats_or_posts_a_l_affiche')==0) {
				include (TEMPLATEPATH . '/frontpage_posts.php'); 
			} else {
				include (TEMPLATEPATH . '/frontpage_cats.php');
			}
		?>	
		<div class="span2">
			<?php get_sidebar('middle-index'); ?>
		</div>
		<div class="span2">
			<?php get_sidebar('right'); ?>
		</div>
	<!-- Outer row -->
	</div>
	<!-- Page container -->
</div> 
<?php get_footer(); ?>
