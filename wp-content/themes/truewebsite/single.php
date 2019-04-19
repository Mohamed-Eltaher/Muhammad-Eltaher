<?php get_header(); ?>
<section class="singl">
	<div class="container">
		<div class="wrapper-post">
		<?php
			while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content-single', get_post_type() );	
		?>					
		</div>
		<div class="wrapper-aside"> <?php get_sidebar(); ?> </div>
	</div>
</section>

	<?php 
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

			endwhile;
	?>					

<?php get_footer(); ?>
