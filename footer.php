<div class="hero-unit footer">
	<div id="footer" class="container">
		<div class="row">
			<div id="footer1" class="span3">
				<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) : ?> 		
				<?php endif; ?>		
			</div>
			<div id="footer2" class="span3">
				<h3>Articles les plus comment&eacute;s</h3>
				<ul><?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , 10"); 	foreach ($result as $topfive) { 	$postid = $topfive->ID; 	$title = $topfive->post_title; 	$commentcount = $topfive->comment_count;  	if ($commentcount != 0) { ?> 	<li><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>"><?php echo $title ?></a></li> 	<?php } } ?>  
				</ul>
				<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) ) : ?> 
				<?php endif; ?>
			</div>
			<div id="footer3" class="span3">
				<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(5) ) : ?> 
				<?php endif; ?>
			</div>
		<div id="footer4" class="span3">
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(6) ) : ?> 
				<?php endif; ?>
		</div>
	</div>
</div>

<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->

<!-- </div> -->
<?php if ( get_option('ecs_google_analytics') <> "" ) { echo stripslashes(get_option('ecs_google_analytics')); } ?>
</div>
</body>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-transition.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-carousel.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-dropdown.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-tooltip.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-popover.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/application.js"></script>
</html>
