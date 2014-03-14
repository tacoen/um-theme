<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package um
 */

function um_comments_args($user_identity,$commenter,$req, $aria_req) {

	return array(
		'id_form'           => 'commentform',
		'id_submit'         => 'submit',
		'title_reply'       => __( 'Leave a Reply','um' ),
		'title_reply_to'    => __( 'Leave a Reply to %s','um' ),
		'cancel_reply_link' => __( 'Cancel Reply','um' ),
		'label_submit'      => __( 'Post Comment','um' ),

	'must_log_in' => 
		'<p class="must-log-in">' .
		sprintf(
		__( 'You must be <a href="%s">logged in</a> to post a comment.' ),
		wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		) . '</p>',

	'logged_in_as' => 
		'<p class="logged-in-as">' .
		sprintf(
		__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
		admin_url( 'profile.php' ),
		$user_identity,
		wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		) . '</p>',

	'comment_notes_after' => 
		'<p class="form-allowed-tags">' .
		sprintf(
		__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
		' <code>' . allowed_tags() . '</code>'
		) . '</p>' .
		'<p class="comment-notes">' .
		__( 'Your email address will not be published.','um') . ( $req ? $required_text : '' ) .
		'</p>' ,
	
	'comment_notes_before' => '',
	
	'fields' => apply_filters( 'comment_form_default_fields', array(

		'author' =>
			'<p class="comment-form-author  half">' .
			'<label for="author">' . __( 'Name', 'domainreference' ) .
			( $req ? '<span class="required">*</span>' : '' ) .
			'</label> ' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30"' . $aria_req . ' /></p>',

		'email' =>
			'<p class="comment-form-email half"><label for="email">' . __( 'Email', 'domainreference' ) . 
			( $req ? '<span class="required">*</span>' : '' ) .
			'</label> ' .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'" size="30"' . $aria_req . ' /></p>',

		'url' =>
			'<p class="comment-form-url fill"><label for="url">' .
			__( 'Website', 'domainreference' ) . '</label>' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" /></p>'
		)),
	
	'comment_field' => 
//		"<P>um_comments_args($user_identity,$commenter,$req, $aria_req)</p>".
		'<p class="comment-form-comment fill"><label for="comment">'. _x( 'Comment', 'noun','um' ) .
		'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
		'</textarea></p>',

	);
}

function um_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<article id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<footer class="comment-meta">
		<div class="comment-author vcard">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
		</div>
<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','um') ?></em>
		<br />
<?php endif; ?>

		<div class="comment-metadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s','um'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','um'),'  ','' );
			?>
		</div>
		</footer>

		<div class="comment-content"><?php comment_text() ?></div>

		<div class="reply">
		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</article>
		<?php endif; ?>
<?php }

 
if ( ! function_exists( 'um_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function um_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'um' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'um' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'um' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'um_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function um_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'um' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<i class="dashicons dashicons-arrow-left-alt"></i> %title', 'Previous post link', 'um' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <i class="dashicons dashicons-arrow-right-alt"></i>', 'Next post link',     'um' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'um_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function um_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on"><i class="dashicons dashicons-clock"></i> %1$s</span> <span class="byline"><i class="dashicons dashicons-admin-users"></i> %2$s</span>', 'um' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function um_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so um_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so um_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in um_categorized_blog.
 */
function um_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'um_category_transient_flusher' );
add_action( 'save_post',     'um_category_transient_flusher' );
