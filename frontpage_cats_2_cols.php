<div class="span8">
	<?php	 
	$nbcats = 0;
	$maxposts=get_option('ecs_nb_a_l_affiche');
	for ($i=0; $i <1000 ; $i++) { 
		$cat_id = get_option('ecs_cats_a_l_affiche_'.$i);
		if ($cat_id) {
			$nbcats += 1;
			$cat = get_category($cat_id); ?>
			<?php if ($nbcats % 2 == 1) : ?>
				<div class="row alaffiche">
			<?php endif; ?>
				<div class="span4 frontpage-cat" >
					<a href="<?php echo get_category_link( $cat->cat_ID ); ?>"><h3 <?php if ($cat->description) : ?>style="border-top: 10px solid <?php echo $cat->description ?>; color:<?php echo $cat->description ?>;" <?php endif; ?>><?php echo $cat->name ?></h3></a>
					<?php 
					$args = array( 'posts_per_page' => get_option('ecs_nb_a_l_affiche'), 'category' => $cat_id.",-".get_option('ecs_cat_a_la_une') );

					$myposts = get_posts( $args );
					$nbposts = 0;
					foreach ( $myposts as $post ) : setup_postdata( $post ); $nbposts += 1; ?>
						<?php if ($nbposts == 1) { ?>
							<div class="row">
							<!-- <div class="span2"> -->
								<ul class="thumbnails">
									<li class="span2">
										<a href="<?php the_permalink() ?>" class="thumbnail">
											<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=170&h=120&zc=1&q=100">
										</a>
									</li>
									<div class="span2">
										<a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br/>
						
										<?php echo ecs_short_excerpt(20); ?>
									</div>
								</ul>
							</div>
						<?php } else { ?>
							<div class="post">
								<a href="<?php the_permalink() ?>"><?php the_title(); ?></a> | <?php the_time('j/m/Y') ?> : <?php echo ecs_short_excerpt(15); ?><br/>
								
							</div>
							<?php if ($nbposts == $maxposts) { break; }?>
						<?php } ?>
						<?php endforeach; 
						wp_reset_postdata();?>
				</div>
			<?php if ($nbcats % 2 == 0) : ?>
			</div>
		<?php endif; ?>
		<?php }
			// if ($nbcats == 4) { break; }
	}  ?>
</div>
			