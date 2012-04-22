<?php /*
Example template for use with post thumbnails
Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>
<h3>Articles similaires</h3>
<?php if (have_posts()):?>
<ul>
	<?php while (have_posts()) : the_post(); ?>

		<?php $thumbnail = get_custom_thumbnail(the_ID()) ; if ($thumbnail):?>
		<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=260&h=180&zc=1&q=100"></a></li>
		<?php endif; ?>
	<?php endwhile; ?>
</ul>

<?php else: ?>
<p>No related photos.</p>
<?php endif; ?>
