<?php
/**
 * @package undressme
 */
?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php get_template_part('post-header',get_post_format()); ?>

	<?php if(is_search()): // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'undressme')); ?>
		<?php
			wp_link_pages(array(
				'before' => '<div class="page-links">' . __('Pages:', 'undressme'),
				'after' => '</div>',
			));
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

<?php get_template_part('post-footer',get_post_format()); ?>
</article><!-- #post-## -->
