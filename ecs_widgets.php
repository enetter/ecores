<?php 

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
		$instance['nbposts'] = strip_tags($new_instance['nbposts']);
		// and now we return new values and wordpress do all work for you
		return $instance;
	}
 
	/** @see WP_Widget::form */
	function form($instance) {
		$default = 	array( 'title' => __('Articles similaires'), 'nbposts' => 5 );
		$instance = wp_parse_args( (array) $instance, $default );
 
		$field_id = $this->get_field_id('title');
		$field_name = $this->get_field_name('title');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Title').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['title'] ).'" /><label></p>';

		$field_id = $this->get_field_id('nbposts');
		$field_name = $this->get_field_name('nbposts');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Nb Articles').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['nbposts'] ).'" /><label></p>';

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
				<?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); $cat =  get_single_top_category(get_the_ID()); ?>
				<li>
					<span style="color:<?php echo $cat->description ?>"><span style="background-color:<?php echo $cat->description ?>"><i class="icon-chevron-right icon-white"></i></span><?php echo $cat->name ?></span><br/>
					<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
					<p>
					<?php 
						echo ecs_short_excerpt(20);
					?>
				</p>
				</li>
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
		// and now we return new values and wordpress do all work for you
		return $instance;
	}
 
	/** @see WP_Widget::form */
	function form($instance) {
		$default = 	array( 'title' => __('Articles récents'), 'nbposts' => 5 );
		$instance = wp_parse_args( (array) $instance, $default );
 
		$field_id = $this->get_field_id('title');
		$field_name = $this->get_field_name('title');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Title').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['title'] ).'" /><label></p>';

		$field_id = $this->get_field_id('nbposts');
		$field_name = $this->get_field_name('nbposts');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Nb Articles').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['nbposts'] ).'" /><label></p>';

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
	  $recent_posts = new WP_Query(array('post_type'=>'post','posts_per_page'=>5, 'orderby' => 'comment_count')); ?>
		<?php if ($recent_posts->have_posts()):?>
			<ul>
				<?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); $cat =  get_single_top_category(get_the_ID());?>
				<li>
					<span style="color:<?php echo $cat->description ?>"><span style="background-color:<?php echo $cat->description ?>"><i class="icon-chevron-right icon-white"></i></span><?php echo $cat->name ?></span><br/>
					<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>&nbsp;<span class="badge" title="Nb de commentaires"><?php echo get_comments_number(); ?></span>
					<p>
					<?php 
						echo ecs_short_excerpt(20);
					?>
				</p>
				</li>
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
		// and now we return new values and wordpress do all work for you
		return $instance;
	}
 
	/** @see WP_Widget::form */
	function form($instance) {
		$default = 	array( 'title' => __('Articles commentés'), 'nbposts' => 5 );
		$instance = wp_parse_args( (array) $instance, $default );
 
		$field_id = $this->get_field_id('title');
		$field_name = $this->get_field_name('title');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Title').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['title'] ).'" /><label></p>';

		$field_id = $this->get_field_id('nbposts');
		$field_name = $this->get_field_name('nbposts');
		echo "\r\n".'<p><label for="'.$field_id.'">'.__('Nb Articles').': <input type="text" class="widefat" id="'.$field_id.'" name="'.$field_name.'" value="'.attribute_escape( $instance['nbposts'] ).'" /><label></p>';

	}
}


register_widget('Ecs_RSS_Widget');
register_widget('Ecs_Related_Posts_Widget');
register_widget('Ecs_Recent_Posts_Widget');
register_widget('Ecs_Commented_Posts_Widget');

?>