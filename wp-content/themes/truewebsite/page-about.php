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
				<!-- About Me Section -->
			    <section class="about">	
			    	<div class="container">
				  		<div class="about-content">
				  			<h1 class="about-head"><?php echo get_theme_mod('head_option'); ?></h1>
				  			<?php echo wpautop(get_theme_mod('text_option')); ?>
				  		</div>
				  		<div class="about-img">
				  			<img src="<?php echo wp_get_attachment_url(get_theme_mod('me_custome_image')); ?>" alt="muhammad eltaher">
				  		</div>
				  	</div>
				</section>
		</section>
	</main>
</div>

<?php get_footer(); ?>
