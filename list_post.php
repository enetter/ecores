<div class="row">
	<div class="span2">
		<ul class="thumbnails">
			<li class="span2">
				<a href="<?php the_permalink() ?>" class="thumbnail">
					<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=160&h=120&zc=1&q=100">
				</a>
			</li>
		</ul>
	</div>
	<div class="span5">
		
		Publié le <?php the_time('j F Y') ?>  par <?php the_author(); ?>&nbsp;
		<?php if (get_comments_number()>0) : ?>
			<span class="badge" title="Nb de commentaires"><?php echo get_comments_number(); ?></span>
		<?php endif; ?>
		<br/>
		<a href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>
		<?php the_excerpt(); ?>
	</div>
</div><br/>
