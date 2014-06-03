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

	<?php /* 
	<div class="widget-area"><?php if(dynamic_sidebar('element-1')) ?></div>
	*/ ?>
	
	<nav id="site-navigation" class="main-navigation" role="navigation">
	<h1 class="menu-toggle"><i class="umi-menus"></i><span><?php bloginfo('name'); ?></span></h1>
	<a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'um'); ?></a>
	<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
	</nav><!-- #site-navigation -->

</div>

<footer id="colophon" class="site-footer" role="contentinfo">
	<?php get_template_part('um-footer'); ?>
	<div class="site-info inside micro"><?php umtag('credits'); ?></div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
<!-- <?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds. -->
</body>
</html>