</div>  
</div>
</div>
<div id="footer" class="container">
	<div class="row">
		<div id="recentpost" class="span4">
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) : ?> 		
			<?php endif; ?>		
		</div>
		<div id="mostcommented" class="span4">
			<h3>Articles les plus comment&eacute;s</h3>
			<ul><?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , 5"); 	foreach ($result as $topfive) { 	$postid = $topfive->ID; 	$title = $topfive->post_title; 	$commentcount = $topfive->comment_count;  	if ($commentcount != 0) { ?> 	<li><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>"><?php echo $title ?></a></li> 	<?php } } ?>  
			</ul>
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) ) : ?> 
			<?php endif; ?>
		</div>
		<div id="recent_comments" class="span4">
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(5) ) : ?> 
		<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<hr class="soften">
			<div id="footer"> <?php wp_footer(); ?> Propuls&eacute; par <a href="http://wordpress.org/">WordPress</a> | 
				<a href="<?php bloginfo('rss2_url'); ?>">Articles (RSS)</a> | <a href="<?php bloginfo('comments_rss2_url'); ?>">Commentaires (RSS)</a> | <a href="http://github.com/enetter/ecores" target="_blank">EcoRes</a> par <a href="http://www.cplusn.com" target="_blank">Emmanuel Netter</a>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>

<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->

</div>
<?php if ( get_option('ecs_google_analytics') <> "" ) { echo stripslashes(get_option('ecs_google_analytics')); } ?>
</div>
</body>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-carousel.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-dropdown.js"></script>
<script type="text/javascript">
	$('#top_carousel').carousel({
  	interval: 4000
	});
	$('.dropdown-toggle').dropdown();
</script>
</html>
