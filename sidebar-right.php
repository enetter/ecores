<div id="sidebar-right" class="sidebar">
	<?php if ( get_option('ecs_google_adsense') <> "" ) : ?> 
		<ul id="sidebar-ads">
			<h3>Liens commerciaux</h3>
			<div>
				<div>
					<?php echo stripslashes(get_option('ecs_google_adsense')); ?>
				</div>
			</div>
		</ul>
	<?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : /* Widgetized sidebar, if you have the plugin installed. */ 	?>
<?php endif; ?>
</div>
