<?php get_header(); ?>
<div id="page" class="container">
	<div class="row">
		<div class="span8">
			<?php if(!is_paged()) { ?>
				<?php include (TEMPLATEPATH . '/carousel.php'); ?>
			<?php } ?>
		</div>
		<div class="span4">
			<div class="row">
				<div class="span4">
					<div class="subheader-top"><h3>L'habitat éco-responsable sur votre mobile !</h3></div>
				</div>
			</div>
			<div class="row">
				<div class="span2">
					<div class="subheader-top"><h3>Les dossiers</h3></div>
				</div>
				<div class="span2">
					<div class="subheader-bottom"><h3>Les forums</h3></div>
				</div>
			</div>
		</div>
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
