<div id="top_carousel" class="carousel slide">
	<?php query_posts("cat='".get_option('ecs_cat_a_la_une')."'"); ?>
  <!-- Carousel items -->
  <div class="carousel-inner">
  	<?php while (have_posts()) : the_post(); ?>
	    <div class="item">
				<?php	if ( has_post_thumbnail() ) { 
				 $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>
				 	<a href="<?php the_permalink() ?>" rel="bookmark" title="Lien permanent vers <?php the_title(); ?>">
          	<img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php
              echo $large_image_url[0]; ?>&w=870&h=450&zc=1&q=100">
          </a>
					<?php } else { ?>
					 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php bloginfo('template_directory'); ?>/bootstrap/img/bootstrap-mdo-sfmoma-02.jpg&w=870&h=450&zc=1&q=100">
					<?php } ?>
	    	<div class="carousel-caption">
	    		<h4><?php the_title(); ?></h4>
	    		<p><?php the_excerpt(); ?></p>
	    	</div>
	    </div>
    <?php endwhile; ?>
  </div>
	  <!-- Carousel nav -->
	  <a class="carousel-control left" href="#top_carousel" data-slide="prev">&lsaquo;</a>
	  <a class="carousel-control right" href="#top_carousel" data-slide="next">&rsaquo;</a>
	</div>