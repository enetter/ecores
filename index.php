<?php get_header(); ?>
	
	<?php if(!is_paged()) { ?>

	<div id="top" class="clearfloat">
	
		<div id="headline"><div id="headers">A la une</div>
	
		<?php query_posts("showposts=1&cat='".get_option('afr_cat_a_la_une')."'"); ?>
		<?php while (have_posts()) : the_post(); ?>	
	
	<div class="title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></div>
	<div class="meta"><? echo custom_time_comments_views() ?></div>	
	<?php $values = get_post_custom_values("Headline");?>
 	<a href="<?php the_permalink() ?>" rel="bookmark" title="Lien permanent vers <?php the_title(); ?>">
<img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php
$values = get_post_custom_values("Image"); echo $values[0]; ?>&w=300&h=275&zc=1&q=100"
alt="<?php the_title(); ?>" class="left" width="300px" height="275px"  /></a>
	<?php the_excerpt(); ?>
	<div class="followup"><a href="<?php the_permalink() ?>" rel="bookmark" title="Lien permanent vers <?php the_title(); ?>">Lire la suite &raquo;</a></div>
	<?php endwhile; ?>
		</div>
		
	<div id="featured">
	<div id="headers">A l'affiche</div>

	<?php query_posts("showposts=4&cat='".get_option('afr_cat_a_l_affiche')."'"); $i = 1; ?>

		
      	<?php while (have_posts()) : the_post(); ?>
	<div class="clearfloat">
	<?php $values = get_post_custom_values("Image");
	if (isset($values[0])) { ?>
      <a href="<?php the_permalink() ?>" rel="bookmark" title="Lien permanent vers <?php the_title(); ?>">
	<img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php
$values = get_post_custom_values("Image"); echo $values[0]; ?>&w=100&h=65&zc=1&q=100"
alt="<?php the_title(); ?>" class="left" width="100px" height="65px"  /></a>
      <?php } ?>
	<div class="info"><a href="<?php the_permalink() ?>" rel="bookmark" class="title"><?php the_title(); ?></a>
<div class="meta"><? echo custom_time_comments_views() ?></div>	
	
</div>
    	</div>
	
      <?php endwhile; ?>

	</div>

</div>	

	<div >

&nbsp;
	</div>

	<?php } ?>

	<div id="bottom" class="clearfloat">
		
	<div id="front-list">	
	
	<?php
      $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
      query_posts("cat=-".get_option('afr_cat_a_la_une').",-".get_option('afr_cat_a_l_affiche')."&paged=$page&posts_per_page=.get_option('posts_per_page')"); ?>
	
	<?php while (have_posts()) : the_post(); ?>		

	<div class="clearfloat">
	<h3 class=cat_title><?php the_category(', '); ?> &raquo</h3>
	<div class="title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></div>
	<div class="meta"><? custom_time_comments_views() ?></div>	
	
	<div class="spoiler">
	<?php	$values = get_post_custom_values("Image");
	if (isset($values[0])) { ?>
      <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
	<img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php
$values = get_post_custom_values("Image"); echo $values[0]; ?>&w=150&h=150&zc=1&q=100"
alt="<?php the_title(); ?>" class="left" width="150px" height="150px"  /></a>
      <?php } ?>

    <?php the_excerpt(); ?>
	<div class="followup"><a href="<?php the_permalink() ?>" rel="bookmark" title="Lien permanent vers <?php the_title(); ?>">Lire la suite &raquo;</a></div>
	</div>

	</div>
		
      <?php endwhile; ?>

	<div class="navigation">
		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } 
			else { ?>

			<div class="right"><?php next_posts_link('Page suivante &raquo;') ?></div>
			<div class="left"><?php previous_posts_link('&laquo; Page pr&eacute;c&eacute;dente') ?></div>
			<?php } ?>

	</div>
	
	</div>
		

	<?php get_sidebar(); ?>

	</div>	

<?php get_footer(); ?>
