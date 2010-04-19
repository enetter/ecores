<div id="sidebar">

<?php if ( get_option('ecs_google_adsense') <> "" ) : ?> 
<div id="sidebar-ads">
	<h3>Liens commerciaux</h3>
	<?php echo stripslashes(get_option('ecs_google_adsense')); ?>
</div>
<?php endif; ?>

<div id="sidebar-top"> 
<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>

<?php endif; ?>
</div>


<div id="sidebar-middle" class="clearfloat"> 
   <?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?> 		
    <?php endif; ?> 
</div> 

</div>

<div id="sidebar-bottom"> 
<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) : ?> 

<?php endif; ?> </div>   


</div>
