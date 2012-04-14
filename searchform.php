<form method="get" id="searchform" class="navbar-search" action="<?php bloginfo('url'); ?>/">
<input type="text" class="search-query" placeholder="Rechercher"  value="<?php the_search_query(); ?>" name="s" id="s" onfocus="this.value=''" title="Saisissez les termes que vous voulez chercher." />
</form>
