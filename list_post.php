<div class="row">
	 		<div class="span3">
	 			<ul class="thumbnails">
	 				<li class="span3">
						<a href="<?php the_permalink() ?>" class="thumbnail">
							<img src="http://placehold.it/260x180" alt="">
						</a>
					</li>
				</ul>
	 		</div>
	 		<div class="span6">
	 			<p>Publié le <?php the_time('j F Y') ?>  par <?php the_author(); ?></p>
			 	<h2><?php the_title(); ?></h2>
			 	<?php the_excerpt(); ?>
			 	<a href="<?php the_permalink() ?>" rel="bookmark">Lire la suite...</a>
			 	
			 	<p><?php comments_popup_link('Pas de commentaires', 'Un commentaire', '% commentaires', 'label');?> 
			 		<?php $post_categories = wp_get_post_categories( get_the_ID() );
					foreach($post_categories as $c){
						$cat = get_category( $c ); ?>
						<a class="label label-info" href="<?php get_category_link( $c ); ?>"><?php echo $cat->name ?></a>
					<?php } ?>
				</p>
			</div>
		</div>