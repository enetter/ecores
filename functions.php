<?php if ( function_exists('register_sidebar') ) 
	{     
	register_sidebar(array('name' => 'Sidebar Top','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));     
	register_sidebar(array('name' => 'Sidebar Left','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>')); 
	register_sidebar(array('name' => 'Sidebar Right','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));   
	register_sidebar(array('name' => 'Sidebar Bottom','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));    
	register_sidebar(array('name' => 'Footer Left','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));     
	register_sidebar(array('name' => 'Footer Center','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));     
	register_sidebar(array('name' => 'Footer Right','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>')); 
	} 

	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'custom_trim_excerpt');

	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'custom_trim_excerpt');

function custom_trim_excerpt($text) { // Fakes an excerpt if needed
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');

		$text = strip_shortcodes( $text );

		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text);
		$excerpt_length = apply_filters('excerpt_length', 90);
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


////////////////////////////////

// VARIABLES
$themename = "Arthemia-fr";
$shortname = "afr";
$manualurl = 'http://www.cplusn.com/support/arthemia-fr/';
$functions_path = TEMPLATEPATH . '/functions/';
// $includes_path = TEMPLATEPATH . '/includes/';

// Options panel variables and functions
require_once ($functions_path . '/admin-setup.php');

// Options panel settings
require_once ($functions_path . '/admin-options.php');


// Admin Panel
function afr_add_admin() {

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

add_theme_page("Options ".$themename, "Options ".$themename, 'edit_themes', basename(__FILE__), 'afr_page');

}

function afr_page (){

		global $options, $themename, $manualurl;
		
		?>

<div class="wrap">

    			<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

						<h2>Options <?php echo $themename; ?></h2>

						<?php if ( $_REQUEST['saved'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning">Les options d'<?php echo $themename; ?> ont &eacute;t&eacute; mises &agrave; jour !</div><?php } ?>
						<?php if ( $_REQUEST['reset'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning">Les options d'<?php echo $themename; ?> ont &eacute;t&eacute; r&eacute;initialis&eacute;es !</div><?php } ?>						
						
					
						
								
						
						<!--START: GENERAL SETTINGS-->
     						
     						<table class="maintable">
     							
							<?php foreach ($options as $value) { ?>
	
									<?php if ( $value['type'] <> "heading" ) { ?>
	
										<tr class="mainrow">
										<td class="titledesc"><?php echo $value['name']; ?></td>
										<td class="forminp">
		
									<?php } ?>		 
	
									<?php
										
										switch ( $value['type'] ) {
										case 'text':
		
									?>
									
		        							<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings($value['id']); } else { echo $value['std']; } ?>" />
		
									<?php
										
										break;
										case 'select':
		
									?>
		
	            						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
	                					<?php foreach ($value['options'] as $option) { ?>
	                						<option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
	                					<?php } ?>
	            						</select>
		
									<?php
		
										break;
										case 'textarea':
										$ta_options = $value['options'];
		
									?>
									
										<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="8"><?php  if( get_settings($value['id']) != "") { echo stripslashes(get_settings($value['id'])); } else { echo $value['std']; } ?></textarea>
		
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
									
	            					<input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
		
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
 										
	 											$woo_key = $value['id'] . '_' . $key;
												$checkbox_setting = get_settings($woo_key);
				
 												if($checkbox_setting != '') {
		    		
		    											if (get_settings($woo_key) ) { $checked = "checked=\"checked\""; } else { $checked = ""; }
				
												} else { if($key == $value['std']) { $checked = "checked=\"checked\""; } else { $checked = ""; }
				
									} ?>
									
	            					<input type="checkbox" class="checkbox" name="<?php echo $woo_key; ?>" id="<?php echo $woo_key; ?>" value="true" <?php echo $checked; ?> /><label for="<?php echo $woo_key; ?>"><?php echo $option; ?></label><br />
									
									<?php }
		 
										break;
										case "heading":

									?>
									
										</table> 
		    							
		    									<h3 class="title"><?php echo $value['name']; ?></h3>
										
										<table class="maintable">
		
									<?php
										
										break;
										default:
										break;
									
									} ?>
	
									<?php if ( $value['type'] <> "heading" ) { ?>
	
										<?php if ( $value['type'] <> "checkbox" ) { ?><br/><?php } ?><span><?php echo $value['desc']; ?></span>
										</td></tr>
	
									<?php } ?>		
	
							<?php } ?>	
							
							</table>	

							<p class="submit">
								<input name="save" type="submit" value="Save changes" />    
								<input type="hidden" name="action" value="save" />
							</p>							
							
							<div style="clear:both;"></div>		
						
						<!--END: GENERAL SETTINGS-->						
             
            </form>

</div><!--wrap-->

<div style="clear:both;height:20px;"></div>
 
 <?php

};

function afr_wp_head() { 
     $style = $_REQUEST[style];
     if ($style != '') {
          ?> <link href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $style; ?>.css" rel="stylesheet" type="text/css" /><?php 
     } else { 
          $stylesheet = get_option('afr_stylesheet');
          if($stylesheet != ''){
               ?><link href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $stylesheet; ?>" rel="stylesheet" type="text/css" /><?php         
          } else {
			?> <link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet" type="text/css" /><?php 
                 }
     }     
}

add_action('wp_head', 'afr_wp_head');
add_action('admin_menu', 'afr_add_admin');
add_action('admin_head', 'afr_admin_head');	


///////////////////////////////

?>
