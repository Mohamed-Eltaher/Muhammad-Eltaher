<?php get_header(); ?>
<section class="error-404 not-found page-margin">
	<div class="container">
		<header class="page-header">
			<h1 class="page-title special-head"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'hamo' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'hamo' ); ?></p>

			<?php
			get_search_form();

			the_widget( 'WP_Widget_Recent_Posts' );
			?>

			<div class="widget widget_categories">
				<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'hamo' ); ?></h2>
				<ul>
					<?php
					wp_list_categories( array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'show_count' => 1,
						'title_li'   => '',
						'number'     => 10,
					) );
					?>
				</ul>
			</div><!-- .widget -->
		</div><!-- .page-content -->
	</div>
</section><!-- .error-404 -->

<?php
get_footer();
