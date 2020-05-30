<?php
/**
 * Display Home Page
 * @package hamo
 */

get_header(); ?>

<section class="custome-header">
	<img alt="" style=" background-image:linear-gradient( to right bottom, rgba(125, 129, 111, .2), rgba(40, 0, 131, .2)), url('<?php header_image(); ?>')" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>">
	
	<!--<video autoplay loop id="video-background" muted plays-inline>
		<source src="<?php //echo wp_get_attachment_url(get_theme_mod('video_option')); ?>" type="video/mp4">
		</video> -->
		
		<div class="intro site-description">
			<h2><span><?php bloginfo('name') ?></span>
				<span>Easily Improve Your Body</span></h2>
				<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="read-more">Shop Now</a>
			</div>
		</section> 

		<section class="bloge best-seller">
			<div class="container">
				<?php if(have_posts()) { ?>
				<h1 class="blog-head special-head">Best Seller</h1>
				<div class="blog-posts">
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


		<!-- testimonial Section -->

		<?php
		
		$mainTestimonials = new WP_Query(array(
			'post_type'  => 'testimonial',
			'orderby'    => 'meta_value_num',
			'order'      =>'ASC',
		));

		if($mainTestimonials->have_posts()) { ?>
			<section class="bloge testm">
				<div class="container">
					<h1 class="blog-head special-head">We Are Biased. Hear It From The Customers</h1>
					<div class="columns has-text-centered is-multiline">		
						<?php 
						while($mainTestimonials->have_posts()) {
							$mainTestimonials->the_post(); ?>
							<div class="column is-4 testimonial-wrapper">
								<div class="testimonial">
									<p class="quote"><?php the_content(); ?> </p>
									<span class="stars">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</span>
									<p class="attribution"><?php the_title(); ?></p>

								</div>
							</div>		
						<?php } ?>	
					</div>
				</div>
			</section>
		<?php }  ?> 

		<!-- Blog Section -->
		<section class="bloge">
			<div class="container">
				<?php if(have_posts()) { ?>
				<h1 class="blog-head special-head">Latest Posts</h1>		
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