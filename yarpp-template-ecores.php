<?php /*
EcoRes YARPP Template
Author: enetter (Emmanuel Netter)
*/
?>
<?php if (have_posts()):?>
	<ul>
		<?php while (have_posts()) : the_post(); $cat =  get_post_child_category(get_the_ID()); $parent = get_category($cat->parent); ?>
		<li>
			<span style="color:<?php echo $parent->description ?>"><span style="background-color:<?php echo $parent->description ?>"><i class="icon-chevron-right icon-white"></i></span><?php echo $cat->name ?></span><br/>
			<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
			<p>
			<?php 
				echo ecs_short_excerpt(20);
			?>
		</p>
		</li>
		<?php endwhile; ?>
	</ul>
<?php else: ?>
	<ul><li>
		<p>Pas d'articles similaires.</p>
	</li></ul>
<?php endif; ?>
