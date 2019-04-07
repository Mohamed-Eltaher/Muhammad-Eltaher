<?php get_header(); ?>
<section class="page-margin single-project">
	<div class="container">
		<?php
			while ( have_posts() ) :
				the_post(); ?>
				<div>
					<h1><?php the_title(); ?></h1>		
					<div class="post-content">	
						<?php the_content(); ?>
					</div>
				</div>
				<h1><?php the_title(); ?> Projects</h1>
				<?php
				$mainProjects = new WP_Query(array(
					'post_type'  => 'project',
					'orderby'    => 'meta_value_num',
					'order'      =>'ASC',	
				));

				if($mainProjects->have_posts()) { 
					while($mainProjects->have_posts()) {
						$mainProjects->the_post(); ?>
						<div class="meta-box">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php the_excerpt(); ?>											
						</div>
						<hr>
					<?php }} ?>

					<!-- related Projects -->
	<?php   endwhile; ?>						
	</div>
</section>
<?php get_footer(); ?>