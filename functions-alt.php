<?php if ( function_exists('register_sidebar') ) 
	{    
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
 	array( 'main' => __( 'Principal' ))
 	);
}

include (TEMPLATEPATH . '/ecs_widgets.php');


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
		$image_url = bloginfo('template_directory').'/images/placeholder.png';
		$image_url = "http://placehold.it/870x4500";
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


/////////////////////////////////






class ecs_menu_walker extends Walker_Nav_Menu
{
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}

	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$is_top_menu = ($depth == 0) ? true : false;
		// if ($is_top_menu) {
		
			$has_children = ($classes[0] == 'parent') ? true : false;
			$has_children = false;
			
			$dropdown = ($is_top_menu && $has_children ) ? 'dropdown ' :'';
			$class_names = 'class="' . $dropdown . join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) ) . '"' ;
			


			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

			$is_home = ($item->url == site_url().'/') ? true : false;
			$is_current_home = (curPageURL() == site_url().'/') && $is_home ? true : false;
			$item_output = $args->before;
			$item_output .= '<a class="';
			$item_output .= (($is_top_menu && !$has_children) || !$is_top_menu) ? '' : 'dropdown-toggle" data-toggle="dropdown' ;
			$item_output .= (is_category($item->object_id) || $is_current_home) ? 'class="selected" ' : '';
			$item_output .= '"'.$attributes .'>';
			$item_output .= ($is_home) ? '<i class="icon-home icon-white"></i> ' : '';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $is_top_menu && $has_children) ? ' <b class="caret"></b></a>' : '</a>' ;
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		// }
	}

		/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth. It is possible to set the
	 * max depth to include all depths, see walk() method.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];
		// ECS Modifies the class list
		$element->classes = array();

		//display this element
		if ( is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		
		//Adds the 'parent' class to the current item if it has children		
		if( ! empty( $children_elements[$element->$id_field] ) )
			array_push($element->classes,'parent');
		
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		
		call_user_func_array(array(&$this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);
	}
}



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
