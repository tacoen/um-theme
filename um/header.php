<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package undress
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title('|', true, 'right'); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
<?php do_action('before'); ?>
<header id="masthead" class="site-header" role="banner">
<div class="site-branding">
	<div class="inside">
	<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
	<h2 class="site-description"><?php bloginfo('description'); ?></h2>
	</div>
</div>
<div id="um-top">
<?php umtag('breadcrumb');?>
<?php umtag('searchbox'); ?>
</div>
</header><!-- #masthead -->

<div id="content" class="site-content">

