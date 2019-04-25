<?php get_header(); ?>
<section class="single-project">
	<div class="container page-margin">
		<?php
			while ( have_posts() ) :
				the_post(); ?>
				<div>
					<h1 class="special-head"><?php the_title(); ?></h1>		
					<div class="post-content">	
						<?php the_content(); ?>
					</div>
				</div>
				<h2 class="special-head"><?php the_title(); ?> Projects</h2>
				<?php
				$mainProjects = new WP_Query(array(
					'post_type'  => 'project',
					'orderby'    => 'meta_value_num',
					'order'      =>'ASC',
					'meta_query' => array(
					  array(
					    'key' => 'related_language',
					    'compare' => 'LIKE',
					    'value' => '"' . get_the_ID() . '"'
					  )
					)	
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

	<?php   endwhile; ?>						
	</div>
</section>
<?php get_footer(); ?>