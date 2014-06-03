<?php
/**
 * @package um
 */
?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php get_template_part('template-part/post-header',get_post_format()); ?>

	<?php if(is_search()): // Only display Excerpts for Search ?>
	<div class="entry-summary"><?php the_excerpt(); ?></div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content um-content">
		<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'um')); ?>
		<?php
			wp_link_pages(array(
				'before' => '<div class="page-links">' . __('Pages:', 'um'),
				'after' => '</div>',
			));
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

<?php get_template_part('template-part/post-footer',get_post_format()); ?>

</article><!-- #post-## -->
