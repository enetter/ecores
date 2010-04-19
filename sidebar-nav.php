<div id="sidebar-nav">
  <div id="sidebar-nav-top"> 
    <?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>

    <?php endif; ?>
  </div>


  <div id="sidebar-nav-middle"> 

    <?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?> 		
    <?php endif; ?> 
  </div>

  <div id="sidebar-nav-bottom"> 
    <?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) : ?> <?php endif; ?> 
  </div>   
</div>
