<div class="row">
	<div class="span3">
		<ul class="thumbnails">
			<li class="span3">
				<a href="<?php the_permalink() ?>" class="thumbnail">
					<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=260&h=180&zc=1&q=100">
				</a>
			</li>
		</ul>
	</div>
	<div class="span6">
		Publié le <?php the_time('j F Y') ?>  par <?php the_author(); ?><br/> 
		<h2><?php the_title(); ?></h2>
		<?php the_excerpt(); ?>
		<?php $post_categories = wp_get_post_categories( get_the_ID() );
			foreach($post_categories as $c){
				$cat = get_category( $c );?>
				<a class="label label-info" href="<?php echo get_category_link( $c ) ?>"><?php echo $cat->name ?></a>
		<?php } ?>
			<?php comments_popup_link('Pas de commentaires', 'Un commentaire', '% commentaires', 'label pull-right');?>
	</div>
</div>
