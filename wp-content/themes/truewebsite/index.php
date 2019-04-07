<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hamo
 */

get_header();
?>

<section class="custome-header">
	<img alt="" style=" background-image:url('<?php header_image(); ?>')" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>">
</section> 

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<!-- About Section -->
		<div class="about-container">
			<section class="about">	
				<div class="about-content">
					<h1 class="about-head">Hi, I'M MO</h1>
					<?php echo wpautop(get_theme_mod('me_first_option')); ?>
					<?php echo wpautop(get_theme_mod('me_second_option')); ?>
				</div>
				<div class="about-img">
					<img src="<?php echo wp_get_attachment_url(get_theme_mod('me_custome_image')); ?>" alt="">
				</div>
			</section>
		</div>

		<!-- Blog Section -->
		<section class="blog">
			<div class="container">
				<h1 class="blog-head">LATEST POSTS</h1>
				
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

		<!-- Contact Section -->
		<section id="hire" class="contact">
			<div class="container">
				<h1>Contact Me</h1>
				<form>
					<div class="field name-box">
						<input type="text" id="name" placeholder="Your Name"/>
						<label for="name"></label>
					</div>

					<div class="field email-box">
						<input type="text" id="email" placeholder="Email"/>
						<label for="email"></label>
					</div>

					<div class="field msg-box">
						<textarea id="msg" rows="4" placeholder="Your message goes here..."></textarea>
						<label for="msg"></label>
					</div>

					<input class="button" type="submit" value="Send a message" />
				</form>
			</div>
		</section>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>