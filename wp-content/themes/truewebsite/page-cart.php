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
					the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<?php
							// nice breadcrump
							$theParent = wp_get_post_parent_id( get_the_ID() );
							if($theParent) {
							?>
							<p>
								<a href="<?php echo get_permalink($theParent) ?>"><?php echo get_the_title($theParent) ?></a> &raquo;
								<?php the_title() ?>
							</p>
							<?php } else{
										the_title( '<h1 class="entry-title">', '</h1>' );
									}

							?>
						</header><!-- .entry-header -->

						<?php //hamo_post_thumbnail(); ?>

						<div class="entry-content">
							<?php
							the_content();

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hamo' ),
								'after'  => '</div>',
							) );
							?>
						</div><!-- .entry-content -->

					</article><!-- #post-<?php the_ID(); ?> -->
					
				<?php
				endwhile; // End of the loop.
				?>
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
