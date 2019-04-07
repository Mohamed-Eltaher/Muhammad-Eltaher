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
	<section class="singl page-margin">
		<div class="container">
			<div class="wrapper-post">
				<div id="primary" class="content-area">
					<main id="main" class="site-main site-blog">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content-single', get_post_type() );	
						?>
						
					</main>
				</div>
			</div>
			<div class="wrapper-aside"> <?php get_sidebar(); ?> </div>
		</div>
	</section>

	<div class="container">
			<?php the_post_navigation(); ?>
	</div>

	<?php 
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

				endwhile; // End of the loop.
	?>					

<?php get_footer(); ?>
