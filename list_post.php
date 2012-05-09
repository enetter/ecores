<?php 
	$cat = get_post_child_category($post->ID);
	if ($cat->parent == 0)
		$parent = $cat;
	else
		$parent = get_category($cat->parent); 
?>
<div class="row">
	<div class="span2">
		<ul class="thumbnails">
			<li class="span2">
				<a href="<?php the_permalink() ?>" class="thumbnail">
					<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=170&h=120&zc=1&q=100">
				</a>
			</li>
		</ul>
	</div>
	<div class="span6">
		<span style="color:<?php echo $parent->description ?>"><span style="background-color:<?php echo $parent->description ?>"><i class="icon-chevron-right icon-white"></i></span><?php echo $cat->name ?></span>
		 / Publié le <?php the_time('j F Y') ?>&nbsp;
		<?php if (get_comments_number()>0) : ?>
			<span class="badge" title="Nb de commentaires"><?php echo get_comments_number(); ?></span>
		<?php endif; ?>
		<br/>
		<a href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>
		<?php echo ecs_short_excerpt(50); ?>
	</div>
</div><br/>
