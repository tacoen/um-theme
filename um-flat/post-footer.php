<?php
/**
 * @package um
 */
?>

<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'um' ) );
				if ( $categories_list && um_categorized_blog() ) :
			?>
			<span class="cat-links"><i class="dashicons dashicons-category"></i>
				<?php printf( __( 'Posted in %1$s', 'um' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'um' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links"><i class="dashicons dashicons-tag"></i>
				<?php printf( __( 'Tagged %1$s', 'um' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><i class="dashicons dashicons-admin-comments"></i> <?php comments_popup_link( __( 'Leave a comment', 'um' ), __( '1 Comment', 'um' ), __( '% Comments', 'um' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'um' ), '<span class="edit-link"><i class="dashicons dashicons-edit"></i>', '</span>' ); ?>

</footer><!-- .entry-meta -->

