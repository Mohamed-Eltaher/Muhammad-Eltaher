<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hamo
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main site-blog">
		<section class="blog page-margin">
			<div class="container">
				<?php
				
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content-page', get_post_type() );

				endwhile; // End of the loop.
				?>
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
