<?php get_header(); ?>
<div id="page" class="container">
	<div class="row">
		<div class="span8">
				<?php include (TEMPLATEPATH . '/carousel.php'); ?>
		</div>
			<div class="span4">
				<div class="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) {} ?>
		</div>
		</div>
	</div>
	<div class="row">

		<?php 
			$option = get_option('ecs_cats_or_posts_a_l_affiche');
			if ($option==0) {
				include (TEMPLATEPATH . '/frontpage_posts.php'); 
			} elseif ($option==1) {
				include (TEMPLATEPATH . '/frontpage_posts_image.php');
			} elseif ($option==2) {
				include (TEMPLATEPATH . '/frontpage_cats_2_cols.php');
			} else {
				include (TEMPLATEPATH . '/frontpage_cats.php');
			}
			
		?>	
		<div class="span2">
			<?php  get_sidebar('middle-index'); ?>
		</div>
		<div class="span2">
			<?php  get_sidebar('right'); ?>
		</div>
	<!-- Outer row -->
	</div>
	<!-- Page container -->
</div> 
<?php get_footer(); ?>
