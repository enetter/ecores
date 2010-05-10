<div id="sidebar-nav">
  <div id="sidebar-nav-top"> 
    <?php 	/* Widgetized sidebar, if you have the plugin installed. */ 
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>
  <H3>Rubriques</H3>
  	<ul role="navigation">
		<?php // wp_list_pages('title_li=&sort_column=menu_order&child_of='.$post->ID.'&'); ?>
		<?php
			$common_options = "title_li=&sort_column=menu_order&";
			if(is_home()){
				$children = wp_list_pages($common_options."&echo=0&depth=1");
			}
			else
			{
			
				if(!$post->post_parent){
					// will display the subpages of this top level page
					$children = wp_list_pages($common_options."child_of=".$post->ID."&echo=0");
				}else{
					// diplays only the subpages of parent level
					//$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
					
					if($post->ancestors)
					{
						// now you can get the the top ID of this page
						// wp is putting the ids DESC, thats why the top level ID is the last one
						$ancestors = end($post->ancestors);
						$children = wp_list_pages($common_options."child_of=".$ancestors."&echo=0");
						// you will always get the whole subpages list
					}
				}
			}

			if ($children) { ?>
				<ul>
					<?php echo $children; ?>
				</ul>
		<?php } ?>
    <?php endif; ?>
  </div>

</div>
