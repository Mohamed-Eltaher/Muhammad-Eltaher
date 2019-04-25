<?php get_header(); ?>

<!-- Languages Section -->
<section class="Languages page-margin">
	<div class="container">		
		<h1>All <?php wp_title($sep = '') ?></h1>	
		<?php
		if(have_posts()) { ?>				
			<ul>
				<?php 
					while(have_posts()) {
						the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php } ?>
			</ul>	
			<span class="page-nav">
				<?php 
				previous_posts_link();
				next_posts_link( 'Next Page');
				?>
			</span>
		<?php } ?>
	</div>
</section>

<?php get_footer(); ?>
