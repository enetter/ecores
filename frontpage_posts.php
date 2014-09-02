		<div class="span8">
			<div id="alaffiche" class="page-header">
			  <h1>A l'affiche</h1>
			</div>
				<?php 
					$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = array( 'paged' => $page, 'posts_per_page' => get_option('posts_per_page'), 'category' => get_option('ecs_cat_a_l_affiche') );

					$myposts = new WP_Query( $args );  ?>
					<?php while ($myposts->have_posts() ) : $myposts->the_post(); $cat =  get_single_top_category(get_the_ID()); $cat =  get_single_top_category(get_the_ID());  ?>
							<?php include (TEMPLATEPATH . '/list_post.php'); ?>
				<?php endwhile; ?>
		<!-- Outer span8 -->
		</div> 