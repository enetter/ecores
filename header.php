<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<link rel="icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />

<?php wp_head(); ?>

</head>
<body>
<div id="headpage" class="clearfloat">
	<div id="pages" class="right">
		<ul id="navpage-bar" class="clearfloat">
		<li>&nbsp;</li>
		
		<?php wp_list_pages('sort_column=menu_order&exclude='.get_option('afr_menupages').'&title_li='); ?>
		</ul>
	</div>
</div>
<?php if(get_option('afr_logo')<>""): ?><div id="head" class="clearfloat" style="background-image:url(<?php echo get_option('afr_logo'); ?>)"><?php else: ?><div id="head" class="clearfloat" style="background-image:url(<?php bloginfo('template_directory'); ?>/images/logo.png)"><?php endif; ?>

<div class="clearfloat">
	<div id="logo" class="left">
	<div id="blogtitle"><?php bloginfo('title'); ?></div>
	
	<div id="tagline"><?php bloginfo('description'); ?></div>
	</div>

	

</div>

<div id="navbar" class="clearfloat">

<ul id="page-bar" class="left clearfloat">

<li><a href="<?php echo get_option('home'); ?>/">Accueil</a></li>

<?php wp_list_categories('sort_column=menu_order&exclude='.get_option('afr_menucat').'&title_li='); ?>

</ul>

<?php include (TEMPLATEPATH . '/searchform.php'); ?>

</div>

</div>

<div id="page" class="clearfloat">
