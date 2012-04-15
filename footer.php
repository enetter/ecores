</div>  
</div>
</div>
<div class="hero-unit footer">
<div id="footer" class="container">
	<div class="row">
		<div id="recentpost" class="span3">
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) : ?> 		
			<?php endif; ?>		
		</div>
		<div id="mostcommented" class="span3">
			<h3>Articles les plus comment&eacute;s</h3>
			<ul><?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , 10"); 	foreach ($result as $topfive) { 	$postid = $topfive->ID; 	$title = $topfive->post_title; 	$commentcount = $topfive->comment_count;  	if ($commentcount != 0) { ?> 	<li><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>"><?php echo $title ?></a></li> 	<?php } } ?>  
			</ul>
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) ) : ?> 
			<?php endif; ?>
		</div>
		<div id="recent_comments" class="span3">
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(5) ) : ?> 
		<?php endif; ?>
		</div>
		<div id="recent_comments" class="span3">
			<h3>A propos de ce blog</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
			<h3>Fils d'information</h3>
			<p>
				<a href="<?php bloginfo('rss2_url'); ?>">Fil des articles</a><br/>
				<a href="<?php bloginfo('comments_rss2_url'); ?>">Fil des commentaires</a>
			</p>
			<h3>Crédits</h3>
			<p> <?php wp_footer(); ?> Propuls&eacute; par <a href="http://wordpress.org/">WordPress</a><br/>
			<a href="http://github.com/enetter/ecores" target="_blank">Thème EcoRes</a> par <a href="http://www.cplusn.com" target="_blank">Emmanuel Netter</a></p>
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
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-transition.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-carousel.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-dropdown.js"></script>
<script type="text/javascript">
	$(function(){
		$('#top_carousel').carousel();
		$('.dropdown-toggle').dropdown();
	});
</script>
</html>
