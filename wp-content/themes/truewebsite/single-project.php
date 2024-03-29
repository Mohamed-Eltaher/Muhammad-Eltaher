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
				<h2>Language(s) Used</h2>
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