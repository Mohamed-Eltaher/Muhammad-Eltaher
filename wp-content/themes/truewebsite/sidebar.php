<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<div class="blog-posts">
		<h3>Recent Posts</h3>
		<?php
		$currentID = get_the_ID();
		$args = array(
			'posts_per_page' => 3,
			'post__not_in' => array($currentID)
		); 
		$the_query = new WP_Query( $args );
		while($the_query->have_posts()) {
			$the_query->the_post(); ?>

			<div class="single-post">		
				<div class="img-container">
					<a href="<?php the_permalink(); ?>">
						<?php
						the_post_thumbnail(array(200, 200));
						?>
					</a>
				</div>
				<div class="post-content">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<div class="post-info">
						<?php the_date(); ?>
					</div>	
				</div>
			</div>

		<?php } 
		wp_reset_postdata();
		?>
	</div>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
