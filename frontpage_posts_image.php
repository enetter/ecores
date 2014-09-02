		<div class="span8">
			<div id="alaffiche" class="page-header">
			  <h1>A l'affiche</h1>
			</div>
			<div class="span8" >
					<?php	$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
								$args = array( 'paged' => $page, 'posts_per_page' => get_option('posts_per_page'), 'category' => get_option('ecs_cat_a_l_affiche') );

								$myposts = new WP_Query( $args );  ?>
					<?php while ($myposts->have_posts()) : $myposts->the_post(); $cat =  get_single_top_category(get_the_ID()); ?>
						<?php $nbposts=$nbposts+1 ?>
						<?php if ($nbposts % 2 == 1) { ?>
							<div class="row">
								<ul class="thumbnails">
									<?php } ?>
									<li class="span4">
										<div id ="frontpage" class="thumbnail">
											<span style="background-color:<?php echo $cat->description?>"><?php echo $cat->name ?></span>
											<a href="<?php the_permalink() ?>">

												<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=370&h=268&zc=1&q=100">
														
											</a>
											<div class="caption frontpage" rel="popover" data-content="<?php echo ecs_short_excerpt(50)?><br/><span class='label'><?php the_time('j/m/Y') ?></span> 
													<span class='label'><?php comments_number('Pas de commentaires', 'Un commentaire', '% commentaires');?></span>" 
													data-original-title="<?php the_title(); ?>">
													<h4><?php the_title(); ?></h4>
											</div>
										</div>
										<!-- Span3 li -->
									</li>
									<?php if ($nbposts % 2 == 0) { ?>
									<!-- Thumbnails ul -->
								</ul>
								<!-- Thumbnails Row div -->
							</div>
						<?php } ?>
					<?php if ($nbposts == $maxposts) { break; }?>
				<?php endwhile; ?>
				<?php if ($nbposts % 2 == 1 ) { ?>
									<!-- Thumbnails ul if -->
								</ul>
								<!-- Thumbnails Row div if -->
							</div>
				<?php } ?>
			<!-- Inner span8 -->
			</div>
		<!-- Outer span8 -->
		</div> 