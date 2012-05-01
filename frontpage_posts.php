		<div class="span8">
			<div id="alaffiche" class="page-header">
			  <h1>A l'affiche</h1>
			</div>
					<?php	$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
								query_posts("cat=".get_option('ecs_cat_a_l_affiche')."&paged=$page&posts_per_page=.get_option('posts_per_page')"); 
							  $nbposts=0; $maxposts=get_option('ecs_nb_a_l_affiche'); ?>
					<?php while (have_posts()) : the_post(); $cat =  get_single_top_category(get_the_ID()); $cat =  get_single_top_category(get_the_ID());  ?>
							<?php include (TEMPLATEPATH . '/list_post.php'); ?>
				<?php endwhile; ?>
		<!-- Outer span8 -->
		</div> 