<?php get_header(); ?>


	<div id="content" class="span9">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); 
	
  ?>
	<div class="post" id="post_<?php the_ID(); ?>">

	<span class="breadcrumbs"><a href="<?php echo get_option('home'); ?>/">Accueil</a> &raquo; <?php the_title(); ?></span>
		
	<h2 class="title"><?php the_title(); ?></h2>
		
		<div class="entry clearfloat">
		<?php the_content('<p class="serif">Lire la suite &raquo;</p>'); ?>

		<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		</div>
    
     <div>
   <ul>
 <?php
  $cat = get_post_meta(get_the_ID(), 'category',true);  
  if ($cat!="") 
  {
  ?>
    <h3><?php echo 'Actualit&eacute;s li&eacute;es' ?></h3>
 <?php

 global $post;
 $myposts = get_posts('numberposts=5&category_name='.$cat);
 foreach($myposts as $post) :
   setup_postdata($post);
 ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
 <?php endforeach; 
 }?>
 </ul> 
 </div>
		
	<?php edit_post_link('Modifier cette page.', '<p>', '</p>'); ?>

	</div>
	
		


	<?php endwhile; endif; ?>

 
  
	</div>
  
<?php get_sidebar('right'); ?>

<?php get_footer(); ?>
