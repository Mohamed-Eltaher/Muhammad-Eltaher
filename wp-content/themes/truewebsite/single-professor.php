<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hamo
 */

get_header();
?>
	<section class="singl professor">
		<div class="container">
			<div class="wrapper-post">
				<div id="primary" class="content-area">
					<main id="main" class="site-main site-blog">
						<?php
						while ( have_posts() ) :
							the_post(); ?>
							<div class="single-post">				
								<div class="post-content">
									<h1><?php the_title(); ?></h1>
									<div class="image">
										<?php the_post_thumbnail('thumbnail') ?>
									</div>
									<div class="content"><?php the_content(); ?></div>
									
									<h2>Related Skill(s)</h2>
									<?php
										$relatedSkills = get_field('related_skill');
										if($relatedSkills) {
											echo "<ul>";
											foreach ($relatedSkills as $Skill) { ?>
													
														<li><?php echo get_the_title($Skill);?> </li>
											<?php 
											}
											echo "</ul>";
										}	
								
									?>
								</div>
							</div>
					</main>
				</div>
			</div>
		</div>
	</section>


	<?php 

				endwhile; // End of the loop.
	?>					

<?php get_footer(); ?>
