<?php 

if ( ! function_exists( 'um_comments_args' ) ) {

function um_comments_args($user_identity,$commenter,$req, $aria_req) {

	$required_text = 'Required';
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
		__( 'You must be <a href="%s">logged in</a> to post a comment.','um' ),
		wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		) . '</p>',

	'logged_in_as' => 
		'<p class="logged-in-as">' .
		sprintf(
		__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','um' ),
		admin_url( 'profile.php' ),
		$user_identity,
		wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		) . '</p>',

	'comment_notes_before' => 
		'<p class="comment-notes">' .
		__( 'Your email address will not be published.','um' ) . ( $req ? $required_text : '' ) .
		'</p>'
	,

	'comment_notes_after' => 
		'<p class="form-allowed-tags">' .
		sprintf(
		__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
		' <code>' . allowed_tags() . '</code>'
		) . '</p>' ,

	
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
		'<p class="comment-form-comment fill"><label for="comment">'. _x( 'Comment', 'noun', 'um' ) .
		'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
		'</textarea></p>',

	);
}

}

if ( ! function_exists( 'um_comment' ) ) {

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
				printf( __('%1$s at %2$s','um'), get_comment_date(),  get_comment_time()) ?></a>
				<?php edit_comment_link(__('Edit','um'),'  ','' );
			?>
		</div>
		</footer>

		<div class="comment-content um-content"><?php comment_text() ?></div>

		<div class="reply">
		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</article>
		<?php endif; ?>
<?php }

}
