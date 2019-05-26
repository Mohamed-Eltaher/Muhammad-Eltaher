<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<div class="bg-color">
<div class="container">
	<div id="primary" class="col-md-12 content-area single-blog">
	    <div class="col-md-2"></div>
	    <div class="col-md-8">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
// 			the_post_navigation( array(
// 				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
// 					'<span class="screen-reader-text">' . __( 'post:', 'twentyfifteen' ) . '</span> ' .
// 					'<span class="post-title">%title</span>',
// 				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
// 					'<span class="screen-reader-text">' . __( 'post:', 'twentyfifteen' ) . '</span> ' .
// 					'<span class="post-title">%title</span>',
// 			) );
        ?>
        <div class="pre-post">
		    <?php previous_post_link(); ?> 
	    </div>
	    <div class="next-post">
		    <?php next_post_link(); ?>
		</div>
        <?php
		// End the loop.
		endwhile;
		?>
		
		

		</main><!-- .site-main -->
		</div>
		<div class="col-md-2"></div>
	</div><!-- .content-area -->
</div>
</div>
<?php get_footer(); ?>

<style>
    .pre-post {
    float: left;
    width: 50%;
}
.next-post {
    float: right;
    text-align: right;
    width: 50%;
}
img {
    max-width: 100%;
    height: 100%;
}
.single ol, .single ul {
    padding-left: 30px;
}
.single ol li, .single ul li {
    list-style-type: disc;
}
h3, h2, h4, h5, h6 {
    color: #4b4b4b;
}
.single #main .entry-footer {
    margin-top: 25px;
}
.single #main .entry-footer span, .single #main #reply-title {
    color: #4b4b4b;
    font-size: 18px;
    font-family: 'Roboto', sans-serif;
}
.single #main .entry-footer span a, .single #main .entry-footer span a time, .single #main .logged-in-as a {
    color: #cf4032;
    margin-right: 5px;
}
.single #main #comment {
    width: 100%;
}
.single #main .form-submit .submit {
    width: auto;
    height: 44px;
    font-size: 20px;
    color: #fff;
    background: url(http://cdn.patch-emblem.com/wp-content/themes/patchemblem/images/form-submit-btn-bg.jpg) center top no-repeat;
    background-size: 100% 100%;
    border: 0;
    text-shadow: 0 0 2px #811601;
    padding: 5px 15px;
}
.single #main .pre-post a {
    margin-top: 20px;
    display: inline-block;
    margin-bottom: 20px;
    color: #cf4032;
}
.single #main  a {
    color: #cf4032;
}
.single #main h1 {
    font-weight: bold;
    font-family: 'PT Sans', sans-serif;
    font-size: 30px;
    color: #2c80a2;
    padding: 0 0 15px;
    margin-top: 40px;
    text-transform: uppercase;
    line-height: 40px;
}
</style>
