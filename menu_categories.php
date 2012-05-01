<div class="navbar">
			<div class="navbar-inner">
					<div class="container"><ul class="nav">
							<li class="<?php if (is_home()) { echo 'current-cat'; } ?>">
								<a href="<?php bloginfo('url');?>"><i class="icon-home icon-white"></i></a>
							</li>
							<?php 
							// Do we display the subnavigation ?
							$is_navigable = (is_category() || is_single());
							// Loop through all first level categories
							$args = array(
								'type'                     => 'post',
								'child_of'                 => '',
								'parent'                   => 0,
								'orderby'                  => 'name',
								'order'                    => 'ASC',
								'hide_empty'               => 1,
								'hierarchical'             => 1,
								'exclude'                  => get_option('ecs_cat_a_la_une').','.get_option('ecs_cat_a_l_affiche'),
								'include'                  => '',
								'number'                   => '',
								'taxonomy'                 => 'category',
								'pad_counts'               => false );
							$categories = get_categories($args);
							foreach ($categories as $key => $cat) {
								$category_url = get_category_link( $cat->term_id );
								$category_name = $cat->name;
								
								if (is_single()) {
									$post_categories = get_the_category();
									$selected = in_array($cat, $post_categories);
									// Search for first top level cat of post, and store it
									foreach ($post_categories as $key => $post_cat) {
										if ($cat->term_id == $post_cat->term_id) {
											if (empty($single_root_cat)) {
												$selected = true;
												$single_root_cat = $cat ;
											}
											break;
										}
									}
								}
								else
								{ 
									// See if the current cat or one of its children is selected
									$category_children = explode(',',get_category_children_id($cat->cat_ID));
									$selected = ($is_navigable && (get_query_var('cat')==$cat->term_id || in_array(get_query_var('cat'),$category_children)) && !is_home());
								}	
								global $current_cat_color;
								if ($selected) {
									$sel_nav_cat_class = 'cat'.$cat->term_id;
									$current_cat_color = $cat->description;
								}
								$cat_class  = 'class="'.'cat'.$cat->term_id;
								$cat_class .= ($selected) ? ' active"' : '"';
								?>					
						  	<li <?php echo $cat_class; ?>>
						  		<a href="<?php echo esc_url($category_url); ?>"><?php echo $category_name; ?></a>
						  	</li>
					  		<?php } ?>
						</ul>
						<ul class="nav pull-right">
							<?php include (TEMPLATEPATH . '/searchform.php'); ?>
						</ul>
					</div>
				</div>
		</div>
		<?php if (!is_home() && $is_navigable) : 
			if (is_single()) {
    		$cat_id = $single_root_cat->term_id;
    	}
    	else
    	{	
    		$cat_id = get_query_var('cat');
    	}
    	$children = get_category_children($cat_id);
    	if ($children =='') {
    		$cat = get_category($cat_id);
    		$cat_id = $cat->parent;
    	}
			$args = array( 'parent' => $cat_id );
			$parent = get_category($cat_id);
			?>
			<div class="subnav subnav-fixed" >
				<div class="container">
					<ul class="nav nav-pills">
			    <?php
						$categories = get_categories($args);
						foreach ($categories as $key => $cat) { 
							$category_url = get_category_link( $cat->term_id );
							$category_name = $cat->name; 
							$selected = false;
							if (is_single()) {
									$post_categories = get_the_category();
									foreach ($post_categories as $key => $post_cat) {
										if ($cat->term_id == $post_cat->term_id) {
											$selected = true;
											break;
										}
									}
								}
								else
								{
									$selected = (get_query_var('cat')==$cat->term_id);
								}

							?>
							<li <?php $output = 'class="'.$sel_nav_cat_class; 
										$output .= ($selected) ? ' active"' : '"';
										echo $output; ?>>
						  		<a href="<?php echo esc_url($category_url); ?>"><?php echo $category_name; ?></a>
						  </li>
						<?php } ?>
					</ul>
				</div>
		  </div>
		<?php endif; ?>