<!-- 		<div class="span8"> -->
			<!-- <div class="span8" > -->
				<?php	 
				$nbcats = 0;
				for ($i=0; $i <1000 ; $i++) { 
					$cat_id = get_option('ecs_cats_a_l_affiche_'.$i);
					if ($cat_id) {
						$nbcats += 1;
						$cat = get_category($cat_id); ?>
							<div class="span2 frontpage-cat" >
								<h3 <?php if ($cat->description) : ?>style="border-top: 10px solid <?php echo $cat->description ?>; color:<?php echo $cat->description ?>;" <?php endif; ?>><?php echo $cat->name ?></h3>
									<ul>
								<?php 
									query_posts("cat=".$cat_id.",-".get_option('ecs_cat_a_la_une')."&posts_per_page=<?php echo get_option('ecs_nb_a_l_affiche'); ?>"); 
									$nbposts = 0;
									while (have_posts()) : the_post(); $nbposts += 1;?>
										<?php if ($nbposts == 1) { ?>
											<li class="frontpage-cat-first">
												<div class="thumbnail">
													<a href="<?php the_permalink() ?>">
														<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=160&h=120&zc=1&q=100">
													</a>
													<div class="caption frontpage" rel="popover" data-content="<?php echo ecs_short_excerpt(20).'<br/>'?><span class='label'><?php the_time('j/m/Y') ?></span> 
															<span class='label'><?php comments_number('Pas de commentaires', 'Un commentaire', '% commentaires');?></span>" 
															data-original-title="<?php the_title(); ?>">
															<h5><?php the_title(); ?></h5>
													</div>
												</div>
												<!-- Span2 li -->
											</li>
										<?php } else { ?>
											<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
													<?php if (get_comments_number()) : ?>
														&nbsp;<span class="badge" title="Nb de commentaires"><?php echo get_comments_number(); ?></span></a>
													<?php endif; ?>
												<p>
												<?php 
													echo ecs_short_excerpt(20);
												?>
												<br/>
												<span class="post-info">Publié le <?php the_time('j/m/Y') ?></span>
												</p>
												<!-- <hr> -->
											</li>
										<?php } ?>
									<?php endwhile; ?>
								</ul>
							</div>
					<?php }
						if ($nbcats == 4) { break; }
				}  ?>
			<!-- Inner span8 -->
			<!-- </div> -->
		<!-- Outer span8 -->
		<!-- </div>  -->