<div id="top_carousel" class="carousel slide">
	<?php query_posts("showposts=4&cat='".get_option('ecs_cat_a_la_une')."'"); ?>
  <!-- Carousel items -->
  <div class="carousel-inner">
  	<?php while (have_posts()) : the_post(); ?>
	    <div class="item">
	    	<a href="<?php the_permalink() ?>" rel="bookmark" title="Lien permanent vers <?php the_title(); ?>">
				<!-- <img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php
				$values = get_post_custom_values("Image"); echo $values[0]; ?>&w=300&h=275&zc=1&q=100"
				alt="<?php the_title(); ?>" class="left" width="300px" height="275px"  /> -->
				<?php	if ( has_post_thumbnail() ) { ?>
					 <?php the_post_thumbnail(); ?>
					<?php } else { ?>
					 <img src="<?php bloginfo('template_directory'); ?>/bootstrap/img/bootstrap-mdo-sfmoma-02.jpg">
					<?php } ?>
				</a>
	    	<div class="carousel-caption">
	    		<h4><?php the_title(); ?></h4>
	    		<p><?php the_excerpt(); ?></p>
	    	</div>
	    </div>
    <?php endwhile; ?>
  </div>
	  <!-- Carousel nav -->
	  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>