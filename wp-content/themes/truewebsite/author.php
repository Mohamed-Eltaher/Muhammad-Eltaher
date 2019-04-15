<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hamo
 */

get_header();
?>
	<!-- Blog Section -->
	<section class="bloge page-margin">
		<div class="container">
	  		
	  		<div class="blog-content blog-page-content">
	  			<?php the_archive_title('<h1 class="blog-head special-head">', '</h1>'); ?>
	  			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
				
	  		</div>

			<div id="primary" class="content-area">
				<main id="main" class="site-main site-blog">		
					<?php if(have_posts()) {
					?>
			  		<div class="blog-posts">
			  			<?php
			  				while(have_posts()) {
									the_post();
		  					get_template_part('content', get_post_format());

			  			 } ?>
			  		</div>
			  		<span class="page-nav">
				  		<?php 
				  			previous_posts_link();
				  			next_posts_link( 'Next Page');
				  		?>
			  		</span>
			  		<?php } ?>
				 </main>
			</div>
		</div>
	</section>
	
<?php get_footer(); ?>