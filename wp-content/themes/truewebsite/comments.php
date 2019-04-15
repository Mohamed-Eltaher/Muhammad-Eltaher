<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hamo
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>


	<div id="comments" class="comments-area page-margin">
	<div class="container">
		<?php
		// You can start editing here -- including this comment!
		if ( have_comments() ) :
			?>
			<h1 class="comments-title">
				<?php
				$hamo_comment_count = get_comments_number();
				if ( '1' === $hamo_comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html__( 'One Comment on &ldquo;%1$s&rdquo;', 'hamo' ),
						'<span>' . get_the_title() . '</span>'
					);
				} else {
					printf( // WPCS: XSS OK.
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s Comments on &ldquo;%2$s&rdquo;', '%1$s Comments on &ldquo;%2$s&rdquo;', $hamo_comment_count, 'comments title', 'hamo' ) ),
						number_format_i18n( $hamo_comment_count ),
						'<span>' . get_the_title() . '</span>'
					);
				}
				?>
			</h1><!-- .comments-title -->

			<?php the_comments_navigation(); ?>

			<ol class="comment-list">
				<?php
				wp_list_comments( array(
				'walker'			=> null,
					'max_depth' 		=> '',
					'style'				=> 'ol',
					'callback'			=> null,
					'end-callback'		=> null,
					'type'				=> 'all',
					'reply_text'		=> 'Reply',
					'page'				=> '',
					'per_page'			=> '',
					'avatar_size'		=> 64,
					'reverse_top_level' => null,
					'reverse_children'	=> '',
					'format'			=> 'html5',
					'short_ping'		=> false,
					'echo'				=> true
				) );
				?>
			</ol><!-- .comment-list -->
			
			<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) :
				?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'hamo' ); ?></p>
				<?php
			endif;

		endif; // Check for have_comments().

		global $aria_req;
		$fields =  array(

		  'author' =>
		    '<p class="comment-form-author"><label for="author">' . __( 'Name', 'domainreference' ) .
		    ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
		    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		    '" size="30"' . $aria_req . ' /></p>',

		  'email' =>
		    '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) .
		    ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
		    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		    '" size="30"' . $aria_req . ' /></p>',

		);

		$args = array(
			
			'class_submit' => 'submit-btn',
			'label_submit' => __( 'Submit Comment' ),
			'comment_field' =>
				'<div><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <span class="required">*</span><textarea id="comment" class="form-textarea" name="comment" rows="4" required="required"></textarea></p>',
			'fields' => apply_filters( 'comment_form_default_fields', $fields )
			
		);
		comment_form($args);

		?>

	</div>
</div><!-- #comments -->
