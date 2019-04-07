<?php get_header(); ?>

<!-- Blog Section -->
<section class="bloge page-margin">
	<div class="container">		
		<div>
			<h1 class="blog-head">All Languages</h1>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>		
		</div>

		<!-- Languages Section -->
		<?php
		if(have_posts()) { ?>
			<div class="blog-posts">
				<?php 
				while(have_posts()) {
					the_post(); ?>
					<div class="single-post">				
						<div class="post-content">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							
						</div>
					</div>		
				<?php } ?>
			</div>
			<span class="page-nav">
				<?php 
				previous_posts_link();
				next_posts_link( 'Next Page', $the_query->max_num_pages);
				?>
			</span>
		<?php } ?>
	</div>
</section>

<?php get_footer(); ?>
