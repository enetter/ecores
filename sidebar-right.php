<div class="span3">
	<div id="sidebar" class="well sidebar-nav">
		<?php if ( get_option('ecs_google_adsense') <> "" ) : ?> 
			<ul id="sidebar-ads" class="nav nav-list">
				<li class="nav-header">Liens commerciaux</li>
				<div>
					<?php echo stripslashes(get_option('ecs_google_adsense')); ?>
				</div>
			</ul>
		<?php endif; ?>
	</div>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : /* Widgetized sidebar, if you have the plugin installed. */ 	?>
	<?php endif; ?>
</div>

