<?php get_header(); ?>
<div class="page">
	<div class="container">
		<div class="row">
			<div class="span8">
					<?php ecs_carousel("cat='".get_option('ecs_cat_a_la_une')."'"); ?>
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
				$option = get_option('ecs_col_centre_or_right');
			?>	
			<?php 
  			$option = get_option('ecs_col_centre_or_right');
			?>  
			<div class="span2">
				<?php  if ($option==0) { get_sidebar('middle-index');} else {get_sidebar('right');} ?>
			</div>
			<div class="span2">
				<?php  if ($option==0) { get_sidebar('right');} else {get_sidebar('middle-index');} ?>
			</div>
		<!-- Outer row -->
		</div>
		<!-- Page container -->
	</div>
</div> 
<?php get_footer(); ?>
