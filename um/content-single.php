<?php
/**
 * @package um
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php get_template_part('single-header',get_post_format()); ?>

<div class="entry-content">
	<?php the_content(); ?>
	<?php
		wp_link_pages(array(
			'before' => '<div class="page-links">' . __('Pages:', 'um'),
			'after' => '</div>',
		));
	?>
</div><!-- .entry-content -->

<?php get_template_part('single-footer',get_post_format()); ?>

</article><!-- #post-## -->
