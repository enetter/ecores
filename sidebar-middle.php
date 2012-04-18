<div id="sidebar-middle" class="sidebar">
	<ul id="sidebar-block">	
		<div>	
			<?php related_posts() ?>
		</div>	
	</ul>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : /* Widgetized sidebar, if you have the plugin installed. */ 	?>
	<?php endif; ?>
</div>


