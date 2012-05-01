<div class="hero-unit footer">
	<div id="footer" class="container">
		<div class="row">
			<div class="span4">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(7) ) : ?> 		
				<?php endif; ?>	
			</div>	
			<div class="span4">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(8) ) : ?> 	
			
				<?php endif; ?>	
			</div>	
			<div class="span4">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(9) ) : ?> 		
				<?php endif; ?>	
				<h3>Crédits</h3>
				Propulsé par <a href="http://wordpress.org/">WordPress</a><br/>
				<a href="http://github.com/enetter/ecores" target="_blank">Thème EcoRes</a>
				par
				<a href="http://www.cplusn.com" target="_blank">Emmanuel Netter</a>
			</div>	
	</div>
</div>

<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->

<!-- </div> -->
<?php if ( get_option('ecs_google_analytics') <> "" ) { echo stripslashes(get_option('ecs_google_analytics')); } ?>
</div>
<?php wp_footer(); ?>
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
