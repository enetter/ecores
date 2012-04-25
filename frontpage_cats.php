<!-- 		<div class="span8"> -->
			<div class="span8" >
				<?php	 for ($i=0; $i <1000 ; $i++) { 
					$cat_id = get_option('ecs_cats_a_l_affiche_'.$i);
					if ($cat_id) {
						$cat = get_category($cat_id); ?>
						<div class="row">
							<div class="span2">
								<h3><?php echo $cat->name ?></h3>
							</div>
							<?php 
								query_posts("cat=".$cat_id.",-".get_option('ecs_cat_a_la_une')."&posts_per_page=3"); 
								while (have_posts()) : the_post(); ?>
									<li class="span2">
										<div class="thumbnail">
											<a href="<?php the_permalink() ?>">
												<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=160&h=120&zc=1&q=100">
											</a>
											<div class="caption frontpage" rel="popover" data-content="<?php the_excerpt()?><span class='label'><?php the_time('j/m/Y') ?></span> 
													<span class='label'><?php comments_number('Pas de commentaires', 'Un commentaire', '% commentaires');?></span>" 
													data-original-title="<?php the_title(); ?>">
													<h5><?php the_title(); ?></h5>
											</div>
										</div>
										<!-- Span2 li -->
									</li>
								<?php endwhile; ?>
						</div>
						<hr>

					<?php }
				}  ?>
			<!-- Inner span8 -->
			</div>
		<!-- Outer span8 -->
		<!-- </div>  -->