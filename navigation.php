<?php if (function_exists('wp_pagenavi')) : ?>
	<div class="pager">
		<?php wp_pagenavi(); ?>
	</div>
<?php else : ?>
	<ul class="pager">
	  <li class="next">
	  	<?php next_posts_link('Plus anciens &rarr;'); ?>
	  </li>
	  <li class="previous">
	    <?php previous_posts_link('&larr; Plus r&eacute;cents'); ?>
	  </li>
	</ul>
<?php endif; ?>