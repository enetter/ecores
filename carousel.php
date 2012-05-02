<div id="top_carousel" class="carousel slide">
	<?php query_posts("cat='".get_option('ecs_cat_a_la_une')."'"); ?>
  <!-- Carousel items -->
  <div class="carousel-inner">
  	<?php $first=true; while (have_posts()) : the_post(); $cat =  get_single_top_category(get_the_ID()); ?>
	    <div class="item <?php if ($first) { echo 'active'; $first=false; } ?>">
	    	<div class="row">
	    		<a href="<?php the_permalink() ?>" rel="bookmark" title="Lien permanent vers <?php the_title(); ?>">
	    	<div class="span4">

				 	
				 		
          	<img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo get_custom_thumbnail($post) ?>&w=370&h=240&zc=1&q=100">
          	
          
          
         </div>
	    	<div class="span4">

	    		<h2><?php the_title(); ?></h2>
	    		<p><?php echo ecs_short_excerpt(50); ?></p>
	    	</div>
	    	</a>
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