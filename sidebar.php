<div id="sidebar">

<?php if ( get_option('afr_google_adsense') <> "" ) : ?> 
<div id="sidebar-ads">
	<h3>Liens commerciaux</h3>
	<?php echo stripslashes(get_option('afr_google_adsense')); ?>
</div>
<?php endif; ?>

<div id="sidebar-top"> 
<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>

<?php endif; ?>
</div>


<div id="sidebar-middle" class="clearfloat"> 
<div id="sidebar-left">
<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?> 		
<?php endif; ?> 
<ul><?php wp_list_bookmarks('categorize=0&category=17&title_li=0&show_images=0&show_description=0&orderby=name'); ?></ul>
</div>  

<div id="sidebar-right">
<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) : ?> 		

<h3>Liens</h3>
<ul>
<li><a href="http://www.cplusn.com">cplusn.com</a></li>
<li><a href="http://michaelhutagalung.com">Michael Jubel</a></li>
</ul>
<?php endif; ?>
</div> 

</div>

<div id="sidebar-bottom"> 
<?php 	/* Widgetized sidebar, if you have the plugin installed. */ 					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) ) : ?> 
<h3>Tags</h3><div class="tags">	
<?php
$tags = get_tags(array('orderby' => 'name', 'order' => 'ASC') );
foreach ( (array) $tags as $tag ) {
?>

<?php echo '<a href="' . get_tag_link ($tag->term_id) . '" rel="tag">' .'<strong>'.ucfirst(substr($tag->name,0,1)).'</strong>'.substr($tag->name,(strlen($tag->name)-1)*-1). '</a>&nbsp; ';	?>
<?php		}
?>  </div>
<?php endif; ?> </div>   


</div>
