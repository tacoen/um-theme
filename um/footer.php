<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package um
 */
?>
</div><!-- #content -->

<div id="um-bottom">
<nav id="site-navigation" class="main-navigation" role="navigation">
	<h1 class="menu-toggle" data-icon="b"><span><?php _e('Menu', 'undress'); ?></span></h1>
	<a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'undress'); ?></a>
	<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
</nav><!-- #site-navigation -->
</div>

<footer id="colophon" class="site-footer" role="contentinfo">
	<?php get_template_part('um-footer'); ?>
	<div class="site-info"><?php umtag('credits'); ?></div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->
<?php 
wp_footer();
?></body>
</html>