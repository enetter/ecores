<?php get_header(); ?>
<div class="page">
	<div id="page" class="container">
		<div class="row">
			<div class="span8">
				<div class="page-header">
				  <h1>Vous cherchez une 404 ?</h1>
				</div>
			
				<div class="alert alert-error">
					Désolé, mais ce n'est pas ici que vous la trouverez. Essayez plutôt d'utiliser le <strong>menu de navigation</strong>, les <strong>liens en bas de page</strong>, 
					les <strong>tags dans la barre latérale</strong> ou <strong>la recherche.</strong>
				</div>
				<ul class="thumbnails">
				  <li class="span8">
				    <div class="thumbnail">
				      <img src="<?php bloginfo('template_directory'); ?>/images/404.jpg">
				    </div>
				  </li>
				</ul>
				<p >Photo par <a href="http://www.flickr.com/photos/saabir/">aostefan</a></p>
			</div>
			<div class="span2">
				<?php get_sidebar('middle-archive'); ?>
			</div>
			<div class="span2">
				<?php get_sidebar('right'); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
