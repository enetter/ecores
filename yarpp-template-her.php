<?php /*
EcoRes YARPP Template
Author: enetter (Emmanuel Netter)
*/
?>
<?php if (have_posts()):?>
	<ul>
		<?php while (have_posts()) : the_post(); ?>
		<li>
			<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
		</li>
		<?php endwhile; ?>
	</ul>
<?php else: ?>
	<ul><li>
		<p>Pas d'articles similaires.</p>
	</li></ul>
<?php endif; ?>
