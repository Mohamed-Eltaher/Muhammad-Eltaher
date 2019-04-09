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
			<h1 class="blog-head">All Projects</h1>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>		
		</div>

		<!-- Projects Section -->
		<?php
		if(have_posts()) { ?>

			<div class="blog-posts">
				<?php 
				while(have_posts()) {
					the_post(); ?>
					<div class="single-post">				
						<div class="post-content">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="post-info">
								<?php hamo_posted_by(); ?>
							</div>
							<p><?php echo wp_trim_words(get_the_content(), 45) ?></p>
							<div href="#" class="read-more">Project Date <?php the_field('project_date'); ?></div>
							<div class="entry-footer">
								<?php hamo_entry_footer(); ?>
							</div>
						</div>
					</div>		
				<?php } ?>
			</div>
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