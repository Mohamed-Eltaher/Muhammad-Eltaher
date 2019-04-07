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
				<h1>Language(s) Used</h1>
				<?php
				$relatedLanguages = get_field('related_language');
				if($relatedLanguages) {
					echo "<ul>";
					foreach ($relatedLanguages as $language) { ?>
						<li><a href="<?php echo get_the_permalink($language); ?>"><?php echo get_the_title($language);?> </a></li>
						<hr>
					<?php 
						}
					echo "</ul>";
				}
			endwhile; 
		?>						
	</div>
</section>
<?php get_footer(); ?>