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
<footer id="colophon" class="site-footer" role="contentinfo">
<div id="um-bottom">
	<?php get_template_part('um-footer'); ?>
	<div class="site-info"><?php umtag('credits'); ?></div><!-- .site-info -->
</div>
</footer><!-- #colophon -->
</div><!-- #page -->
<?php 
wp_footer();
?></body>
</html>