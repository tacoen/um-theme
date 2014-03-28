<?php
/**
 * @package um
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); }?>
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php um_posted_on(); ?>
			<?php edit_post_link(__('Edit', 'um'), '<span class="edit-link"><i class="dashicons dashicons-edit"></i>', '</span>'); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages(array(
				'before' => '<div class="page-links">' . __('Pages:', 'um'),
				'after' => '</div>',
			));
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list(__(', ', 'um'));

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list('', __(', ', 'um'));

			if(! um_categorized_blog()){
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if('' != $tag_list){
					$meta_text = __(
					'<span class="d"><i class="dashicons dashicons-share"></i> <a href="%3$s" rel="bookmark">permalink</a></span>'.
					'<span class="d"><i class="dashicons dashicons-tag"></i> %2$s</span>'
					, 'um');					
				} else {
					$meta_text = __(
					'<span class="d"><i class="dashicons dashicons-share"></i> <a href="%3$s" rel="bookmark">permalink</a></span>'
					, 'um');
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if('' != $tag_list){
					$meta_text = __(
									'<span class="d"><i class="dashicons dashicons-share"></i> <a href="%3$s" rel="bookmark">permalink</a></span>'.
									'<span class="d"><i class="dashicons dashicons-category"></i> %1$s</span>'.
								'<span class="d"><i class="dashicons dashicons-tag"></i> %2$s</span>'
									, 'um');
				} else {
					$meta_text = __(
									'<span class="d"><i class="dashicons dashicons-share"></i> <a href="%3$s" rel="bookmark">permalink</a></span>'.
									'<span class="d"><i class="dashicons dashicons-category"></i> %1$s</span>'
									, 'um');
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
