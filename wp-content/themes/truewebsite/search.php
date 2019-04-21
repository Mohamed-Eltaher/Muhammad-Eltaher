<?php get_header(); ?>

<div class="singl">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="wrapper-post">
				<header class="page-header">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'hamo' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile; ?>

			<span class="page-nav">
				<?php 
				previous_posts_link();
				next_posts_link( 'Next Page');
				?>
			</span>
			<?php
		else :

			get_template_part( 'template-parts/content', 'none' ); ?>
			<div class="wrapper-aside"> <?php get_sidebar(); ?> </div>
		<?php
		endif;
		?>
		</div>
		<div class="wrapper-aside"> <?php get_sidebar(); ?> </div>
	</div> <!-- container -->
</div>
<?php
get_footer();
