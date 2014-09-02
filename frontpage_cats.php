<?php	 
$maxposts=get_option('ecs_nb_a_l_affiche');
for ($i=1; $i <5 ; $i++) { 
	$cat_id = get_option('ecs_cats_col_'.$i);
	if ($cat_id) {
		$cat = get_category($cat_id); ?>
			<div class="span2 frontpage-cat" >
				<a href="<?php echo get_category_link( $cat->cat_ID ); ?>"><h3 <?php if ($cat->description) : ?>style="border-top: 10px solid <?php echo $cat->description ?>; color:<?php echo $cat->description ?>;" <?php endif; ?>><?php echo $cat->name ?></h3></a>
					<ul>
				<?php 
					$args = array( 'posts_per_page' => get_option('ecs_nb_a_l_affiche'), 'category' => $cat_id.",-".get_option('ecs_cat_a_la_une') );

					$myposts = get_posts( $args );
					$nbposts = 0;
					foreach ( $myposts as $post ) : setup_postdata( $post ); $nbposts += 1; ?>
						<?php if ($nbposts == 1) { ?>
							<li class="frontpage-cat-first">
								<div class="thumbnail">
									<a href="<?php the_permalink() ?>">
										<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=170&h=120&zc=1&q=100">
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
							<? echo ecs_widget_post_display(20, '', true, true); ?>
						<?php } ?>
						<?php if ($nbposts == $maxposts) { break; }?>
					<?php endforeach; 
						wp_reset_postdata();?>
				</ul>
			</div>
	<?php }
}  ?>
			