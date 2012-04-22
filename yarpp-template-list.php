<?php /*
List template
This template returns the related posts as a comma-separated list.
Author: mitcho (Michael Yoshitaka Erlewine)
*/
?><h3>Articles similaires</h3>

<?php if (have_posts()):
	$postsArray = array();
	while (have_posts()) : the_post();
		$postsArray[] = '<a href="'.get_permalink().'" rel="bookmark">'.get_the_title().'</a><!-- ('.get_the_score().')-->';
	endwhile;

echo implode(', '."\n",$postsArray); // print out a list of the related items, separated by commas

else:?>

<p>Pas d'articles similaires.</p>
<?php endif; ?>
