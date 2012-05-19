<?php if ( function_exists('register_sidebar') ) 
	{    
register_sidebar(array(	'name' => 'Encart Accueil',
												'before_widget' => '<ul><div>',
												'after_widget' => '</div></ul>',
												'before_title' => '<h3>',
												'after_title' => '</h3>')); 
register_sidebar(array(	'name' => 'Col Droite',
												'before_widget' => '<ul id="sidebar-block"><div>',
												'after_widget' => '</div></ul>',
												'before_title' => '<h3>',
												'after_title' => '</h3>')); 
register_sidebar(array(	'name' => 'Col Milieu Accueil',
												'before_widget' => '<ul id="sidebar-block"><div>',
												'after_widget' => '</div></ul>',
												'before_title' => '<h3>',
												'after_title' => '</h3>')); 
register_sidebar(array(	'name' => 'Col Milieu Archive',
												'before_widget' => '<ul id="sidebar-block"><div>',
												'after_widget' => '</div></ul>',
												'before_title' => '<h3>',
												'after_title' => '</h3>')); 
register_sidebar(array('name' => 'Col Milieu Article',
												'before_widget' => '<ul id="sidebar-block"><div>',
												'after_widget' => '</div></ul>',
												'before_title' => '<h3>',
												'after_title' => '</h3>'));     
register_sidebar(array(	'name' => 'Col Milieu Page',
												'before_widget' => '<ul id="sidebar-block"><div>',
												'after_widget' => '</div></ul>',
												'before_title' => '<h3>',
												'after_title' => '</h3>')); 
register_sidebar(array(	'name' => 'Pied de page gauche',
												'before_widget' => '<ul id="sidebar-block"><div>',
												'after_widget' => '</div></ul>',
												'before_title' => '<h3>',
												'after_title' => '</h3>'));     
register_sidebar(array(	'name' => 'Pied de page milieu',
												'before_widget' => '<ul id="sidebar-block"><div>',
												'after_widget' => '</div></ul>',
												'before_title' => '<h3>',
												'after_title' => '</h3>')); 
register_sidebar(array(	'name' => 'Pied de page droit',
												'before_widget' => '<ul id="sidebar-block"><div>',
												'after_widget' => '</div></ul>',
												'before_title' => '<h3>',
												'after_title' => '</h3>')); 
	} 

add_action( 'init', 'register_ecs_menus' );

function register_ecs_menus() {
	register_nav_menus(
 	array( 'main' => __( 'Navigation' ))
 	);
}

include (TEMPLATEPATH . '/ecs_widgets.php');
include (TEMPLATEPATH . '/carousel.php');


	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'custom_trim_excerpt');
	add_filter('widget_tag_cloud_args', 'tag_cloud_filter', 90);

	// remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	// add_filter('get_the_excerpt', 'custom_trim_excerpt');

function tag_cloud_filter($args = array()) {
   $args['smallest'] = 8;
   $args['largest'] = 12;
   $args['unit'] = 'pt';
   return $args;
}



function custom_trim_excerpt($text) { // Fakes an excerpt if needed
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');

		$text = strip_shortcodes( $text );

		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text);
		$excerpt_length = apply_filters('excerpt_length', 80);
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '...');
			$text = implode(' ', $words);
		}
	}
	return $text;
}

function custom_views() {
	$lect = "";
	if(function_exists('the_views')) {
		if (the_views() <> "") { 
			$lect = the_views(false); 
		}
	}
	return $lect;
}

function custom_time_comments_views() {
// Gestion de l'affichage de la date, du nb de commentaires et du nb de lectures 
// si l'utilisateur a coché l'option

?>[<?php the_time('j M Y'); ?> | <?php comments_popup_link('Pas de commentaires', 'Un commentaire', '% commentaires'); ?><?php custom_views(); ?>]
<?php 
}

function get_custom_thumbnail($post) {
	$values = get_post_custom_values("Image");
	if ( has_post_thumbnail() ) { 
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); 
	} elseif (isset($values[0])) {
		$image_url = home_url('/').$values[0];
	} else
	{
		$image_url = bloginfo('template_directory').'/images/blank.png';
	}
	if (is_array($image_url)) {
		$image_url = $image_url[0];
	} 
	return $image_url;

}

function ecs_short_excerpt($length) {
	$excerpt = strip_tags( (string) get_the_excerpt() );
	preg_replace( '/([,;.-]+)\s*/','\1 ', $excerpt );
	$excerpt = implode( ' ', array_slice( preg_split('/\s+/',$excerpt), 0, $length ) ).'...';
	return $excerpt;
}

function category_color_css() {

	$args = array('parent'                   => 0,
								'exclude'                  => get_option('ecs_cat_a_la_une').','.get_option('ecs_cat_a_l_affiche')
								);
	$categories = get_categories($args);
	foreach ($categories as $key => $cat) {
		$cat_class = 'cat'.$cat->term_id;
		if ($cat->description) {
			$output .= '.navbar .nav > li.'.$cat_class.'.active > a, .navbar .nav > li.'.$cat_class.' > a:hover, .subnav .nav > li.'.$cat_class.'.active > a, .subnav .nav > li.'.$cat_class.' > a:hover { background-color:'.$cat->description.'; }  ';

		}		
	}
	return $output;
}

function menu_color_css($menu_name) {
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	  $menu_items = ecs_get_nav_menu_items($menu->term_id, 0);
		foreach ($menu_items as $key => $item) {
			$menu_class = 'menu'.$item->ID;
			if ($item->attr_title) {
				$output .= '.navbar .nav > li.'.$menu_class.'.active > a, .navbar .nav > li.'.$menu_class.' > a:hover, .subnav .nav > li.'.$menu_class.'.active > a, .subnav .nav > li.'.$menu_class.' > a:hover { background-color:'.$item->attr_title.'; }  ';

			}		
		}
		return $output;
	}
}

function get_wp_object_type($obj) {
	if(!empty($obj)) {
		if (property_exists($obj, 'post_type')) {
			return $obj->post_type;
		}
		if (property_exists($obj, 'term_id')) {
			return $obj->taxonomy;
		}
	}
}

function get_current_object_type() {
	return get_wp_object_type(get_queried_object());
}

function get_single_top_category($the_post_id){
	$args = array(
								'parent'                   => 0,
								'exclude'                  => get_option('ecs_cat_a_la_une').','.get_option('ecs_cat_a_l_affiche'),
								);
	$categories = get_categories($args);
	$post_categories = get_the_category($the_post_id);
	foreach ($categories as $key => $cat) {
		// if (in_array($cat, $post_categories)) return $cat;
		// Search for first top level cat of post, and store it
		foreach ($post_categories as $key => $post_cat) {
			if ($cat->term_id == $post_cat->term_id) {
					return $cat ;		
			}
		}
	}
}

function get_post_child_category($the_post_id) {
	$post_categories = get_the_category($the_post_id);
	foreach ($post_categories as $key => $post_cat) {
			if ($post_cat->parent != 0) {
					return $post_cat;		
			}
			else
			{
				$tmp_cat = $post_cat;
			}
		}
		return $tmp_cat;
}


function ecs_get_menu_item_from_object($menu_id, $obj) {
	
	$menu_items = wp_get_nav_menu_items($menu_id);
	$object_type = get_wp_object_type($obj);
	if ($object_type=='category') {
		foreach ( (array)$menu_items as $key => $menu_item ) {
			if ($menu_item->object=='category' && $menu_item->object_id==$obj->term_id)
				return $menu_item;
		}
	}
	elseif ($object_type=='post') {
		foreach ( (array)$menu_items as $key => $menu_item ) {
			if ($menu_item->object=='post' && $menu_item->object_id==$obj->ID)
				return $menu_item;
			}
		// try to get the categories
		$post_categories = get_the_category($obj->ID);
		foreach ( (array)$menu_items as $key => $menu_item ) {
			if ($menu_item->object=='category')
				{
					$cat = get_category($menu_item->object_id);
					foreach ($post_categories as $key => $post_cat) {
						if ($post_cat->term_id == $cat->term_id ) {
							if($menu_item->menu_item_parent>0)
								return $menu_item;
							else
								$temp_item = $menu_item;
						}

					}
				} 
			}
			return $temp_item;
	}
	elseif ($object_type=='page') {
		foreach ( (array)$menu_items as $key => $menu_item ) {
			if ($menu_item->object=='page' && $menu_item->object_id==$obj->ID)
				return $menu_item;
		}
	}
	elseif ($object_type=='forum') {
		foreach ( (array)$menu_items as $key => $menu_item ) {
			if ($menu_item->object=='forum' && $menu_item->object_id==$obj->ID)
				return $menu_item;
		}
	}
	else {
		error_log('ECS unknown object type: '.$object_type);
	}
}


function ecs_get_nav_menu_items($menu_id, $parent_id) {

	$menu_items = wp_get_nav_menu_items($menu_id);
	$menu_items_final = array();
	foreach ( (array)$menu_items as $key => $menu_item ) {
		if ($menu_item->menu_item_parent==$parent_id)
			$menu_items_final[] = $menu_item;
		}
	return $menu_items_final;
}

function ecs_get_top_menu_item_id($menu_item) {

	error_log($menu_item->term_id);
	if ($menu_item->menu_item_parent == 0)
		{
			return $menu_item->ID;
		}
		else
		{
			return $menu_item->menu_item_parent;
		}
}

function ecs_nav_menu($menu_name){

global $current_cat_color;
global $current_object;
global $current_top_menu_item;

	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu_items = ecs_get_nav_menu_items($menu->term_id, 0);
		$current_object = get_queried_object();
		if(!empty($current_object)) { // Not Home page
			$current_object_id = get_queried_object_id();
			$current_object_type = get_wp_object_type($current_object);
			$current_menu_item = ecs_get_menu_item_from_object($menu->term_id, $current_object);
			$top_menu_item_id = ecs_get_top_menu_item_id($current_menu_item);
			if ($current_object_type == 'category') {
				if ($current_object->parent == 0 ) {
					$current_cat_color = $current_object->description;
				}
				else
				{
					$parent_cat = get_category($current_object->parent);
					$current_cat_color = $parent_cat->description;
				}
				
			} 
			else
			{
				$post_categories = get_the_category();
			}
		}
?>
	<div class="navbar">
		<div class="navbar-inner">
				<div class="container">
					<ul class="nav">
						<li class="<?php if (is_home()) { echo 'current-cat'; } ?>">
							<a href="<?php bloginfo('url');?>"><i class="icon-home icon-white"></i></a>
						</li>
						<?php 
						foreach($menu_items as $key => $item) {
							$selected = ($item->object_id==$current_object_id 
												|| in_array($current_menu_item, ecs_get_nav_menu_items($menu->term_id, $item->ID)) 
												|| $current_menu_item == $item
												);
							if ($selected) {}
								$current_top_menu_item = $item;
							$menu_class = 'class="menu'.$item->ID;
							$menu_class .= ($selected) ? ' active"' : '"';
						?>
					  	<li <?php echo $menu_class; ?>>

					  		<a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
					  	</li>
				  	<?php } ?>
					</ul>
					<ul class="nav pull-right">
						<?php include (TEMPLATEPATH . '/searchform.php'); ?>
					</ul>
				</div>
			</div>
		</div>
		<?php // if (!empty($current_cat) || is_single()) : 

			if ($top_menu_item_id)
				$nav_submenu_items = ecs_get_nav_menu_items($menu->term_id, $top_menu_item_id);
			if ($nav_submenu_items) :
			?>
				<div class="subnav subnav-fixed" >
					<div class="subnav-inner">
						<div class="container">
							<ul class="nav nav-pills">
					    <?php
					    	$post_categories = get_the_category();
					    	//print_r($post_categories_id);
								foreach ($nav_submenu_items as $key => $item) { 

										foreach ($post_categories as $key => $post_cat) {
											if ($item->object == 'category' && $item->object_id == $post_cat->term_id) {
												$selected = true;
												break;
											}
										}
									$selected = ($item->object_id==$current_object_id || $current_menu_item->ID == $item->ID);
									$menu_class = 'class="menu'.$top_menu_item_id;
									$menu_class .= ($selected) ? ' active"' : '"';
									?>
									<li <?php echo $menu_class; ?>>
								  		<a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
								  </li>
								<?php } ?>
							</ul>
						</div>
					</div>
			  </div>
		<?php endif; ?>


<?php
	}
	else
	{
		?>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
						<ul class="nav">
							<li><a href="#">Pas de menu trouvé</a></li>
						</ul>
					</div>
				</div>
			</div>
		<?php
	}
}

function ecs_multi_page_post($current_post_id, $posts_array) {
	if(!empty($posts_array)) {
		$count = 1;
		$output = '<select id="multi-page-post" class="multi-page-post">';
		foreach ($posts_array as $post_id) {
			$post = get_post($post_id);
			$output .= '<option '.selected( $post_id, $current_post_id, false).' value="'.get_permalink($post->ID).'">'.$count.' - '.$post->post_title.'</option>';
			$count += 1;
		}
		$output .= '</select>';
		echo $output;
	}
}

/////////////////////////////////




function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


function get_category_children_id($id) {
if ( 0 == $id )
return '';
$cat_ids = get_all_category_ids();
foreach ( $cat_ids as $cat_id ) {
if ( $cat_id == $id)
continue;
$category = get_category($cat_id);
if ( $category->category_parent == $id ) {
$objects .= $category->cat_ID.',';
$objects .= get_category_children_id($category->cat_ID);
}
}
return $objects;
}

////////////////////////////////

// VARIABLES
$themename = "EcoRes";
$shortname = "ecs";
$manualurl = 'http://www.cplusn.com/support/ecores/';
$functions_path = TEMPLATEPATH . '/functions/';
// $includes_path = TEMPLATEPATH . '/includes/';

// Options panel variables and functions
require_once ($functions_path . '/admin-setup.php');

// Options panel settings
require_once ($functions_path . '/admin-options.php');
//
add_theme_support( 'post-thumbnails' ); 

// Admin Panel
function ecs_add_admin() {

	 global $themename, $options;
	
	if ( $_GET['page'] == basename(__FILE__) ) {	
        if ( 'save' == $_REQUEST['action'] ) {
	
                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;
							update_option($up_opt, $_REQUEST[$up_opt] );
						}
					}
				}

                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } 
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;						
							if( isset( $_REQUEST[ $up_opt ] ) ) { update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { delete_option( $up_opt ); } 
						}
					}
				}
						
				header("Location: admin.php?page=functions.php&saved=true");								
			
			die;

		} else if ( 'reset' == $_REQUEST['action'] ) {
			delete_option('sandbox_logo');
			
			header("Location: admin.php?page=functions.php&reset=true");
			die;
		}

	}

add_theme_page("Options ".$themename, "Options ".$themename, 'edit_themes', basename(__FILE__), 'ecs_page');

}

function ecs_page (){

		global $options, $themename, $manualurl;
		
		?>

<div class="wrap">

    			<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

						<h2>Options <?php echo $themename; ?></h2>

						<?php if ( $_REQUEST['saved'] ) { ?><div class="updated settings-errors"><p>Les options d'<?php echo $themename; ?> ont &eacute;t&eacute; mises &agrave; jour !</p></div><?php } ?>
						<?php if ( $_REQUEST['reset'] ) { ?><div class="warning settings-errors"><p>Les options d'<?php echo $themename; ?> ont &eacute;t&eacute; r&eacute;initialis&eacute;es !</p></div><?php } ?>						
						
					
						
								
						
						<!--START: GENERAL SETTINGS-->
     						
     						<!-- <table class="maintable"> -->
     							
							<?php 
									$first = true;
									foreach ($options as $value) { ?>
									<?php if ( $value['type'] <> "heading" ) { ?>
	
										<tr >
										<th scope="row"><label><?php echo $value['name']; ?></label></td>
										<td>
		
									<?php } ?>		 
	
									<?php
										
										switch ( $value['type'] ) {
										case 'text':
		
									?>
									
		        							<input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings($value['id']); } else { echo $value['std']; } ?>" />
		
									<?php
										
										break;
										case 'select':
		
									?>
	            						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
	                					<?php foreach ($value['options'] as $option) { ?>
	                						<option value="<?php echo $option[0]; ?>"  
	                						<?php if ( get_settings( $value['id'] ) == $option[0]) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>>
	                						<?php if (is_array($option)) { echo $option[1];	} else { echo $option; }?></option>
	                					<?php } ?>
	            						</select>
		
									<?php
		
										break;
										case 'textarea':
										$ta_options = $value['options'];
		
									?>
									
										<textarea class="large-text code" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="8"><?php  if( get_settings($value['id']) != "") { echo stripslashes(get_settings($value['id'])); } else { echo $value['std']; } ?></textarea>
		
									<?php
										
										break;
										case "radio":
		
 										foreach ($value['options'] as $key=>$option) { 
				
													$radio_setting = get_settings($value['id']);
													
													if($radio_setting != '') {
		    											
		    											if ($key == get_settings($value['id']) ) { $checked = "checked=\"checked\""; } else { $checked = ""; }
													
													} else {
													
														if($key == $value['std']) { $checked = "checked=\"checked\""; } else { $checked = ""; }
									} ?>
									
	            					<input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /> <?php echo $option; ?><br />
		
									<?php }
		 
										break;
										case "checkbox":
										
										if(get_settings($value['id'])) { $checked = "checked=\"checked\""; } else { $checked = ""; }
									
									?>
		            				
		            				<input type="checkbox" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
		
									<?php
		
										break;
										case "multicheck":
		
 										foreach ($value['options'] as $key=>$option) {
 										
	 											$ecs_key = $value['id'] . '_' . $key;
												$checkbox_setting = get_settings($ecs_key);
				
 												if($checkbox_setting != '') {
		    		
		    											if (get_settings($ecs_key) ) { $checked = "checked=\"checked\""; } else { $checked = ""; }
				
												} else { if($key == $value['std']) { $checked = "checked=\"checked\""; } else { $checked = ""; }
				
									} ?>
		
	            					<input type="checkbox" class="checkbox" name="<?php echo $ecs_key; ?>" id="<?php echo $ecs_key; ?>" value="<?php echo $option[0]; ?>" <?php echo $checked; ?> /><label for="<?php echo $ecs_key; ?>"> <?php if (is_array($option)) { echo $option[1];	} else { echo $option; }?></label><br />
									
									<?php }
		 
										break;
										case "heading":

									?>
									
									<?php if ($first) {
										$first = false;
									} else {
										echo "</table>";
									} ?>
									
					
		    							
		    									<h3 ><?php echo $value['name']; ?></h3>
										
										<table class="form-table">
		
									<?php
										
										break;
										default:
										break;
									
									} ?>
	
									<?php if ( $value['type'] <> "heading" ) { ?>
	
										<?php if ( $value['type'] <> "checkbox" ) { ?><?php } ?><span class="description"><?php echo $value['desc']; ?></span>
										</td></tr>
	
									<?php } ?>		
	
							<?php } ?>	
							
							</table>	

							<p class="submit">
								<input name="save" type="submit" class="button-primary" value="Enregistrer les changements" />    
								<input type="hidden" name="action" value="save" />
							</p>							
							
							<div style="clear:both;"></div>		
						
						<!--END: GENERAL SETTINGS-->						
             
            </form>

</div><!--wrap-->

<div style="clear:both;height:20px;"></div>
 
 <?php

};

function ecs_wp_head() { 
     $style = $_REQUEST[style];
     if ($style != '') {
          ?> <link href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $style; ?>.css" rel="stylesheet" type="text/css" /><?php 
     } else { 
          $stylesheet = get_option('ecs_stylesheet');
          if($stylesheet != ''){
               ?><link href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $stylesheet; ?>" rel="stylesheet" type="text/css" /><?php         
          } else {
			?> <link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet" type="text/css" /><?php 
                 }
     }     
}

add_action('wp_head', 'ecs_wp_head');
add_action('admin_menu', 'ecs_add_admin');
add_action('admin_head', 'ecs_admin_head');	


///////////////////////////////

?>
