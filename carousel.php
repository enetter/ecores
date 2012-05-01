<div id="top_carousel" class="carousel slide">
	<?php query_posts("cat='".get_option('ecs_cat_a_la_une')."'"); ?>
  <!-- Carousel items -->
  <div class="carousel-inner">
  	<?php $first=true; while (have_posts()) : the_post(); $cat =  get_single_top_category(get_the_ID()); ?>
	    <div class="item <?php if ($first) { echo 'active'; $first=false; } ?>">
				 	<a href="<?php the_permalink() ?>" rel="bookmark" title="Lien permanent vers <?php the_title(); ?>">
				 		<span style="background-color:<?php echo $cat->description?>"><?php echo $cat->name ?></span>
          	<img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=570&h=320&zc=1&q=100">
          </a>
	    	<div class="carousel-caption">
	    		<h4><?php the_title(); ?></h4>
	    		<p><?php echo ecs_short_excerpt(40); ?></p>
	    	</div>
	    </div>
    <?php endwhile; ?>
  </div>
	  <!-- Carousel nav -->
	  <?php if ($wp_query->post_count>1) : ?>
		  <a class="carousel-control left" href="#top_carousel" data-slide="prev">&lsaquo;</a>
		  <a class="carousel-control right" href="#top_carousel" data-slide="next">&rsaquo;</a>
		<?php endif; ?>

	</div>