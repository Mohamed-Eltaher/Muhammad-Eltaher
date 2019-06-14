<?php
/**
 * Display Home Page
 * @package hamo
 */

get_header(); ?>

	<section class="custome-header">
	<img alt="" style=" background-image:linear-gradient( to right bottom, rgba(125, 129, 111, .8), rgba(40, 0, 131, .8)), url('<?php header_image(); ?>')" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>">
	
	<!--<video autoplay loop id="video-background" muted plays-inline>
		<source src="<?php //echo wp_get_attachment_url(get_theme_mod('video_option')); ?>" type="video/mp4">
		</video> -->
		
		<div class="intro site-description">
			<h2><span>flexposture </span>
				<span>Easily Improve Your Posture.</span></h2>
				<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="read-more">Shop Now</a>
			</div>
		</section> 

		<section class="bloge best-seller">
			<div class="container">
				<h1 class="blog-head special-head">Best Seller</h1>
				<div class="blog-posts">
					<?php if(have_posts()) { ?>
						<div class="blog-posts">
							<?php 
							while(have_posts()) {
								the_post();
								the_content();
							} ?>
						</div>
					<?php } ?>
				</div>

			</div>
		</section>
<!--
		<section class="bloge best-seller">
			<div class="container">
				<h1 class="blog-head special-head">testimonial</h1>
				<div class="blog-posts">
					

				</div>

			</div>
		</section>
-->
		<!-- Blog Section -->
		<section class="bloge">
			<div class="container">
				<h1 class="blog-head special-head">Latest Posts</h1>		
				<?php if(have_posts()) { ?>
					<div class="blog-posts">
						<?php 
						query_posts('post_type=post');
						while(have_posts()) {
							the_post();
							get_template_part('content', get_post_format());
						} ?>
					</div>
				<?php } ?>
			</div>
		</section>

<?php get_footer(); ?>