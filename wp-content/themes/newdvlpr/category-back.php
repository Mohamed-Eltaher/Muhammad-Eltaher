<?php get_header(); ?>

<div class="container">
	<div class="category-information">
		<h1 class="text-center"><?php single_cat_title(); ?> Category</h1>
		<div class="cat-desc"><?php echo category_description(); ?></div>
	</div>

	<div class="main-post border border-dark">
		<div class="row">
		<?php
			if(have_posts()){

				while(have_posts()) {

					the_post(); ?>
				
					<div class="col-sm-4">
						<div class="post-info">
							<h4 class="post-title">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h4>
							<span class="post-author">
								<i class="fas fa-user-alt"></i>
								<?php the_author_posts_link(); ?>
							</span>
							<span class="post-date">
								<i class="fas fa-calendar-alt"></i>
								<?php the_time(); ?>
							</span>
							<span class="post-comments">
								<i class="fas fa-comments"></i>
								<?php comments_popup_link('0 Comments', 'one comment', '% comments'); ?>
						    </span>
						</div>
						<?php the_post_thumbnail('', ['class'  => 'img-responsive img-thumbnail', 'title'  => 'post img']); ?>
					</div>
					
					<div class="col-sm-5">
						<div class="post-contents">	
							<p class="post-content"><?php the_excerpt(); ?>
								<a href="<?php echo get_permalink(); ?>">Read More...</a>
							</p>
							<hr>

							<div class="post-categorie">
								<i class="fas fa-tags"></i>
								<?php the_category(); ?>
						    </div>

						    <div class="post-tags">
						    	<i class="fas fa-tags"></i>
								<?php
								 if(has_tag()) {
								 	the_tags();
								 } else{
								 	echo "there are no tags here";
								  }
								?> 
						    </div>
						</div>
					</div>

					<div class="col-sm-3">
						<?php

							get_sidebar('back');
							/*
							if(is_active_sidebar('main-sidebar') {
								dynamic_sidebar('main-sidebar')
							});
							*/
						?>
					</div>
		</div>
					
				<?php } //end While
			}  //end If	
		?>	
	</div>

	<?php
	// Pagination
	echo '<div class="post-pagination text-center">';
		if(get_previous_posts_link()) {
			previous_posts_link();
		}else {
			echo '<span>No previous pages | </span>';
		}
		
		if(get_next_posts_link()) {
			next_posts_link();
		}else {
			echo '<span> | No next pages </span>';
		}
	echo '</div>';
	?>

</div>	

<?php get_footer(); ?>