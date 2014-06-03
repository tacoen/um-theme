<?php
/**
 * The Header for our theme.
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package um

 */
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' );?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title(':', true, 'left'); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
<header id="masthead" class="site-header" role="banner">
<div class="site-branding um-headimg">
	<div class="inside">
		<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
		<h2 class="site-description"><?php bloginfo('description'); ?></h2>
	</div>
</div>
<div id="um-top">
	<!-- this is a demo of umtag function -->
	<?php umtag('searchbox'); ?>
	<?php umtag('breadcrumb');?>
</div>
</header><!-- #masthead -->
<div id="content" class="site-content">