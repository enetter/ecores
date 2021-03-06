<?php 

function ecs_widget_post_display($excerpt_length = 20, $cat = '', $has_comments = false ,$has_date = false) {

	// $excerpt_length = empty($instance['excerpt_length']) ? $excerpt_length : $instance['excerpt_length'];
	if (empty($cat) && $excerpt_length==0)
		echo '<li class="sidebar-link">';
	else
		echo '<li>';
	?>
		<?php if (!empty($cat)) : 
			if ($cat->parent == 0) 
				$parent = $cat;
			else
				$parent = get_category($cat->parent); 
		?>

		<span style="color:<?php echo $parent->description ?>"><span style="background-color:<?php echo $parent->description ?>"><i class="icon-chevron-right icon-white"></i></span><?php echo $cat->name ?></span><br/>
		<? endif; ?>
		<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
		<?php 
		$comments_number = get_comments_number();;
		if ($has_comments && $comments_number > 0) : ?>
		&nbsp;<span class="badge" title="Nb de commentaires"><?php echo get_comments_number(); ?></span>
		<? endif; ?>
		<p>
			<?php 
				if ($excerpt_length>0)
					echo ecs_short_excerpt($excerpt_length);
			?>
			<?php if ($has_date) : ?>
			<br/>
			<span class="post-info">Publié le <?php the_time('j/m/Y') ?></span>
			<? endif; ?>
		</p>
	</li>
<?php
}

// RSS Feeds
class Ecs_RSS_Widget extends WP_Widget {
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '&nbsp;ECS RSS Widget' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		?>
      <a href="<?php bloginfo('rss2_url'); ?>">Fil d'information des articles</a><br/>
      <a href="<?php bloginfo('comments_rss2_url'); ?>">Fil d'information des commentaires</a>
		<?php 
		echo $after_widget;
	}

	function Ecs_RSS_Widget() {
		// use parent constructor to re-write standard class properties
		parent::WP_Widget('ecs_rss', 'EcoRes RSS Widget', array('description' => 'Liste les flux RSS des articles et des commentaires', 'class' => 'ecores'));	
	}

	function update($new_instance, $old_instance) {
		// fill current state with old data to be sure we not loose anything
		$instance = $old_instance;
		// for example we want title always have capitalized first letter
		$instance['title'] = strip_tags($new_instance['title']);
		// and now we return new values and wordpress do all work for you
		return $instance;
	}
 
	/** @see WP_Widget::form */
	function form($instance) {
		$default = 	array( 'title' => __('EcoRes Flux RSS') );
		$instance = wp_parse_args( (array) $instance, $default );
 
		$field_id = $this->get_field_id('title');
		$field_name = $this->get_field_name('title');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Title').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['title'] ).'" /><label></p>';
	}
}

// White on color Menu
class Ecs_Menu_Widget extends WP_Widget {
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '&nbsp;ECS Menu Widget' : apply_filters('widget_title', $instance['title']);
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
		$color = $instance['color'];
		echo '<div class="menu-reverse" style="background-color:'.$color.'">';
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		$args = array(
			'menu' => $nav_menu,
			);
		
		wp_nav_menu($args);
		echo $after_widget;
		echo '</div>';
	}

	function Ecs_Menu_Widget() {
		// use parent constructor to re-write standard class properties
		parent::WP_Widget('ecs_menu', 'EcoRes Menu Widget', array('description' => 'Affiche le menu dont le nom est saisi ci-dessous', 'class' => 'ecores'));	
	}

	function update($new_instance, $old_instance) {
		// fill current state with old data to be sure we not loose anything
		$instance = $old_instance;
		// for example we want title always have capitalized first letter
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['color'] = strip_tags($new_instance['color']);
		$instance['nav_menu'] = strip_tags($new_instance['nav_menu']);
		// and now we return new values and wordpress do all work for you
		return $instance;
	}
 
	/** @see WP_Widget::form */
	function form($instance) {
		$default = 	array( 'title' => __('EcoRes Menu'),'color' => '', 'nav_menu' => '' );
		$instance = wp_parse_args( (array) $instance, $default );
 		$title = isset( $instance['title'] ) ? $instance['title'] : '';
 		$color = isset( $instance['color'] ) ? $instance['color'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';


		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
		?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Color:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" value="<?php echo $color; ?>" />
		</p>
		<?php 
	}
}

// Most viewed
class Ecs_Most_Viewed_Widget extends WP_Widget {
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		global $wpdb;
		$temp = '';
		$output = '';
		$limit = empty($instance['nbposts']) ? -1 : $instance['nbposts'];
		// $most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) WHERE post_date < '".current_time('mysql')."' AND $wpdb->term_taxonomy.taxonomy = 'post_tag' AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT $limit");
		// $most_viewed = new WP_Query("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) WHERE post_date < '".current_time('mysql')."' AND $wpdb->term_taxonomy.taxonomy = 'post_tag' AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT $limit");
		$args = array(
				'post_status' => 'publish',
				'meta_key' => 'views',
			  'orderby' => 'meta_value_num', 
			  'order' => 'DESC', 
				'posts_per_page' => $limit
			);
		//$request = "SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) WHERE post_date < '".current_time('mysql')."' AND $wpdb->term_taxonomy.taxonomy = 'post_tag' AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT ".$limit;
		$most_viewed = new WP_Query($args);
		// $most_viewed = new WP_Query();
		// $most_viewed->request = $request;
		// print_r($most_viewed);
		if ($most_viewed->have_posts()): ?>
			<ul>
				<?php while ($most_viewed->have_posts()) : $most_viewed->the_post(); if($instance['show_category']) {$cat =  get_post_child_category(get_the_ID());} ?>
					<? echo ecs_widget_post_display($instance['excerpt_length'], $cat, $instance['show_comments'], $instance['show_date']); ?>
				<?php endwhile; ?>
			</ul>
		<?php else: ?>
			<ul><li>
				<p>Pas d'articles les plus lus.</p>
			</li></ul>
		<?php endif;
	  echo $after_widget; 
	  wp_reset_query();

	}

	function Ecs_Most_Viewed_Widget() {
		// use parent constructor to re-write standard class properties
		parent::WP_Widget('ecs_most_viewed', 'EcoRes Articles les plus lus', array('description' => 'Liste les articles les plus lus', 'class' => 'ecores'));	
	}

	function update($new_instance, $old_instance) {
		// fill current state with old data to be sure we not loose anything
		$instance = $old_instance;
		// for example we want title always have capitalized first letter
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['nbposts'] = strip_tags($new_instance['nbposts']);
		$instance['excerpt_length'] = strip_tags($new_instance['excerpt_length']);
		$instance['show_category'] = strip_tags($new_instance['show_category']);
		$instance['show_comments'] = strip_tags($new_instance['show_comments']);
		$instance['show_date'] = strip_tags($new_instance['show_date']);
		// and now we return new values and wordpress do all work for you
		return $instance;
	}
 
	/** @see WP_Widget::form */
	function form($instance) {
		$default = 	array( 'title' => __('Articles les plus lus'), 'nbposts' => 5, 'show_category' => true, 'show_comments' => false, 'show_date' => false, 'excerpt_length' => 20 );
		$instance = wp_parse_args( (array) $instance, $default );

		$field_id = $this->get_field_id('title');
		$field_name = $this->get_field_name('title');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Title').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['title'] ).'" /><label></p>';

		$field_id = $this->get_field_id('nbposts');
		$field_name = $this->get_field_name('nbposts');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Nb Articles').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['nbposts'] ).'" /><label></p>';	

		$field_id = $this->get_field_id('excerpt_length');
		$field_name = $this->get_field_name('excerpt_length');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Longueur extrait').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['excerpt_length'] ).'" /><label></p>';	

		$field_id = $this->get_field_id('show_category');
		$field_name = $this->get_field_name('show_category');
		echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_category'], true, false ).' /> '.__('Afficher la catégorie').'<label></p>';	

		$field_id = $this->get_field_id('show_comments');
		$field_name = $this->get_field_name('show_comments');
		echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_comments'], true, false ).' /> '.__('Afficher nb de commentaires').'<label></p>';	

		$field_id = $this->get_field_id('show_date');
		$field_name = $this->get_field_name('show_date');
		echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_date'], true, false ).' /> '.__('Afficher date de publication').'<label></p>';	
	}	

}

// Related Posts Widget
class Ecs_Related_Posts_Widget extends WP_Widget {
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
	  if (!function_exists('related_posts') || !related_posts()) {} ;  
		echo $after_widget;
	}

	function Ecs_Related_Posts_Widget() {
		// use parent constructor to re-write standard class properties
		parent::WP_Widget('ecs_related_posts', 'EcoRes Articles similaires', array('description' => 'Articles similaires issus du plugin YARPP', 'class' => 'ecores'));	
	}

	function update($new_instance, $old_instance) {
		// fill current state with old data to be sure we not loose anything
		$instance = $old_instance;
		// for example we want title always have capitalized first letter
		$instance['title'] = strip_tags($new_instance['title']);
		// $instance['nbposts'] = strip_tags($new_instance['nbposts']);
		// $instance['excerpt_length'] = strip_tags($new_instance['excerpt_length']);
		// $instance['show_category'] = strip_tags($new_instance['show_category']);
		// $instance['show_comments'] = strip_tags($new_instance['show_comments']);
		// $instance['show_date'] = strip_tags($new_instance['show_date']);
		// and now we return new values and wordpress do all work for you
		return $instance;
	}
 
	/** @see WP_Widget::form */
	function form($instance) {
		$default = 	array( 'title' => __('Articles similaires') /*, 'nbposts' => 5, 'show_category' => true, 'show_comments' => false, 'show_date' => false, 'excerpt_length' => 20 */ );
		$instance = wp_parse_args( (array) $instance, $default );
 
		$field_id = $this->get_field_id('title');
		$field_name = $this->get_field_name('title');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Title').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['title'] ).'" /><label></p>';

		// $field_id = $this->get_field_id('nbposts');
		// $field_name = $this->get_field_name('nbposts');
		// echo "\r\n".'<p><label for="'.$field_id.'">'.__('Nb Articles').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['nbposts'] ).'" /><label></p>';

		// $field_id = $this->get_field_id('excerpt_length');
		// $field_name = $this->get_field_name('excerpt_length');
		// echo "\r\n".'<p><label for="'.$field_id.'">'.__('Longueur extrait').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['excerpt_length'] ).'" /><label></p>';	

		// $field_id = $this->get_field_id('show_category');
		// $field_name = $this->get_field_name('show_category');
		// echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_category'], true, false ).' /> '.__('Afficher la catégorie').'<label></p>';	

		// $field_id = $this->get_field_id('show_comments');
		// $field_name = $this->get_field_name('show_comments');
		// echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_comments'], true, false ).' /> '.__('Afficher nb de commentaires').'<label></p>';	

		// $field_id = $this->get_field_id('show_date');
		// $field_name = $this->get_field_name('show_date');
		// echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_date'], true, false ).' /> '.__('Afficher date de publication').'<label></p>';	

	}
}

// Recent Posts Widget 
class Ecs_Recent_Posts_Widget extends WP_Widget {
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		$nbposts = empty($instance['nbposts']) ? -1 : $instance['nbposts'];
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
	  $recent_posts = new WP_Query(array('post_type'=>'post','posts_per_page'=>$nbposts)); ?>
		<?php if ($recent_posts->have_posts()):?>
			<ul>
				<?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); if($instance['show_category']) {$cat =  get_post_child_category(get_the_ID());} ?>
					<? echo ecs_widget_post_display($instance['excerpt_length'], $cat, $instance['show_comments'], $instance['show_date']); ?>
				<?php endwhile; ?>
			</ul>
		<?php else: ?>
			<ul><li>
				<p>Pas d'articles récents.</p>
			</li></ul>
		<?php endif; ?>
  <?php 
  echo $after_widget; 
  wp_reset_query();
	}

	function Ecs_Recent_Posts_Widget() {
		// use parent constructor to re-write standard class properties
		parent::WP_Widget('ecs_recent_posts', 'EcoRes Articles récents', array('description' => 'Articles récents de votre blog', 'class' => 'ecores'));	
	}

	function update($new_instance, $old_instance) {
		// fill current state with old data to be sure we not loose anything
		$instance = $old_instance;
		// for example we want title always have capitalized first letter
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['nbposts'] = strip_tags($new_instance['nbposts']);
		$instance['excerpt_length'] = strip_tags($new_instance['excerpt_length']);
		$instance['show_category'] = strip_tags($new_instance['show_category']);
		$instance['show_comments'] = strip_tags($new_instance['show_comments']);
		$instance['show_date'] = strip_tags($new_instance['show_date']);
		// and now we return new values and wordpress do all work for you
		return $instance;
	}
 
	/** @see WP_Widget::form */
	function form($instance) {
		$default = 	array( 'title' => __('Articles récents'), 'nbposts' => 5, 'show_category' => true, 'show_comments' => false, 'show_date' => false, 'excerpt_length' => 20 );
		$instance = wp_parse_args( (array) $instance, $default );
 
		$field_id = $this->get_field_id('title');
		$field_name = $this->get_field_name('title');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Title').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['title'] ).'" /><label></p>';

		$field_id = $this->get_field_id('nbposts');
		$field_name = $this->get_field_name('nbposts');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Nb Articles').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['nbposts'] ).'" /><label></p>';

		$field_id = $this->get_field_id('excerpt_length');
		$field_name = $this->get_field_name('excerpt_length');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Longueur extrait').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['excerpt_length'] ).'" /><label></p>';	

		$field_id = $this->get_field_id('show_category');
		$field_name = $this->get_field_name('show_category');
		echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_category'], true, false ).' /> '.__('Afficher la catégorie').'<label></p>';	

		$field_id = $this->get_field_id('show_comments');
		$field_name = $this->get_field_name('show_comments');
		echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_comments'], true, false ).' /> '.__('Afficher nb de commentaires').'<label></p>';	

		$field_id = $this->get_field_id('show_date');
		$field_name = $this->get_field_name('show_date');
		echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_date'], true, false ).' /> '.__('Afficher date de publication').'<label></p>';	

	}
}

// Most Commented Posts Widget 
class Ecs_Commented_Posts_Widget extends WP_Widget {
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		$nbposts = empty($instance['nbposts']) ? -1 : $instance['nbposts'];
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
	  $recent_posts = new WP_Query(array('post_type'=>'post','posts_per_page'=>$nbposts, 'orderby' => 'comment_count')); ?>
		<?php if ($recent_posts->have_posts()):?>
			<ul>
				<?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); if($instance['show_category']) {$cat =  get_post_child_category(get_the_ID());} ?>
					<? echo ecs_widget_post_display($instance['excerpt_length'], $cat, $instance['show_comments'], $instance['show_date']); ?>
				<?php endwhile; ?>
			</ul>
		<?php else: ?>
			<ul><li>
				<p>Pas d'articles récents.</p>
			</li></ul>
		<?php endif; ?>
  <?php 
  echo $after_widget; 
  wp_reset_query();
	}

	function Ecs_Commented_Posts_Widget() {
		// use parent constructor to re-write standard class properties
		parent::WP_Widget('ecs_commented_posts', 'EcoRes Articles commentés', array('description' => 'Articles les plus commentés de votre blog', 'class' => 'ecores'));	
	}

	function update($new_instance, $old_instance) {
		// fill current state with old data to be sure we not loose anything
		$instance = $old_instance;
		// for example we want title always have capitalized first letter
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['nbposts'] = strip_tags($new_instance['nbposts']);
		$instance['excerpt_length'] = strip_tags($new_instance['excerpt_length']);
		$instance['show_category'] = strip_tags($new_instance['show_category']);
		$instance['show_comments'] = strip_tags($new_instance['show_comments']);
		$instance['show_date'] = strip_tags($new_instance['show_date']);
		// and now we return new values and wordpress do all work for you
		return $instance;
	}
 
	/** @see WP_Widget::form */
	function form($instance) {
		$default = 	array( 'title' => __('Articles commentés'), 'nbposts' => 5, 'show_category' => true, 'show_comments' => false, 'show_date' => false, 'excerpt_length' => 20 );
		$instance = wp_parse_args( (array) $instance, $default );
 
		$field_id = $this->get_field_id('title');
		$field_name = $this->get_field_name('title');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Title').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['title'] ).'" /><label></p>';

		$field_id = $this->get_field_id('nbposts');
		$field_name = $this->get_field_name('nbposts');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Nb Articles').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['nbposts'] ).'" /><label></p>';

		$field_id = $this->get_field_id('excerpt_length');
		$field_name = $this->get_field_name('excerpt_length');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Longueur extrait').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['excerpt_length'] ).'" /><label></p>';	

		$field_id = $this->get_field_id('show_category');
		$field_name = $this->get_field_name('show_category');
		echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_category'], true, false ).' /> '.__('Afficher la catégorie').'<label></p>';	

		$field_id = $this->get_field_id('show_comments');
		$field_name = $this->get_field_name('show_comments');
		echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_comments'], true, false ).' /> '.__('Afficher nb de commentaires').'<label></p>';	

		$field_id = $this->get_field_id('show_date');
		$field_name = $this->get_field_name('show_date');
		echo "\r\n".'<p><label for="'.$field_id.'"><input type="checkbox"  id="'.$field_id.'" name="'.$field_name.'" value="1"'.checked($instance['show_date'], true, false ).' /> '.__('Afficher date de publication').'<label></p>';	

	}
}


register_widget('Ecs_RSS_Widget');
register_widget('Ecs_Menu_Widget');
register_widget('Ecs_Most_Viewed_Widget');
register_widget('Ecs_Related_Posts_Widget');
register_widget('Ecs_Recent_Posts_Widget');
register_widget('Ecs_Commented_Posts_Widget');

?>