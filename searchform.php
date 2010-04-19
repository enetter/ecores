<form method="get" id="searchform" class="left" action="<?php bloginfo('url'); ?>/">
<div>
<input type="text" value="Rechercher..." value="<?php the_search_query(); ?>" name="s" id="s" onfocus="this.value=''" title="Saisissez les termes que vous voulez chercher." /><input type="image" src="<?php echo bloginfo('template_directory'); ?>/images/magnify.gif" id="searchsubmit" />

</div>
</form>
