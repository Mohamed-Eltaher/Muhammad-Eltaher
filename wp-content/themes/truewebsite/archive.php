<?php get_header(); ?>
<section class="bloge">
	<div class="container">
		<div class="blog-content blog-page-content">
			<?php the_archive_title('<h1 class="blog-head special-head">', '</h1>'); ?>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>	
		</div>		
		<?php if(have_posts()) { ?>
			<div class="blog-posts">
				<?php
				while(have_posts()) {
					the_post();
					get_template_part('content', get_post_format());

				} ?>
			</div>
			<span class="page-nav">
				<?php the_posts_pagination( array( 'mid_size'  => 2 ) ); ?>
			</span>
		<?php } ?>	
	</div>
</section>

<?php get_footer(); ?>