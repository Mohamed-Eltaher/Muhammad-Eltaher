<?php get_header(); ?>

<?php include(get_template_directory() . '/includes/breadcrumb.php' ) ?>

<div class="container">
	<div class="main-post border border-dark">
		<span class="post-edit">
			<?php edit_post_link('Edit'); ?>
		</span>
		<div class="row">
		<?php
			if(have_posts()){

				while(have_posts()) {

					the_post(); ?>
					
						<div class="col-sm-6">
							<h4 class="post-title">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h4>
							
							<span class="post-date">
								<i class="fas fa-calendar-alt"></i>
								<?php the_time(); ?>
							</span>
							<span class="post-comments">
								<i class="fas fa-comments"></i>
								<?php comments_popup_link('0 Comments', 'one comment', '% comments'); ?>
						    </span>
							
							<?php the_post_thumbnail('', ['class'  => 'img-responsive img-thumbnail', 'title'  => 'post img']); ?>

					   </div>
					
						<div class="col-sm-6">
							<div class="the-content">
								<p class="post-content"><?php the_content(); ?>
									
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
					
				<?php } //end While
			}  //end If	
		?>	
		</div>
	</div>

	<?php
	// Pagination
	echo '<div class="posts-pagination text-center">';
		echo '<span>';
			if(get_previous_post_link()) {
				previous_post_link();
			}else {
				echo '<span>No previous posts </span>';
			}
		echo '</span>';
		echo '<span>';
			if(get_next_post_link()) {
				next_post_link();
			}else {
				echo '<span> No next posts </span>';
			}
		echo '</span>';
	echo '</div>';
	?>

	<hr>

	<?php
	// random posts of the same categort	

		$random_posts_category = new WP_Query(array(
			'posts_per_page'   => 2,
			'orderby'          =>'rand',
			'category__in'     =>wp_get_post_categories(get_queried_object_id()),
			'post__not_in'     =>array(get_queried_object_id())
		));

		if($random_posts_category->have_posts()){ ?>
			<h4 class="text-center">Random Posts of the same category</h4>
			
				<?php while($random_posts_category->have_posts()) { ?>
					
				<?php $random_posts_category->the_post(); ?>
				
					<div class="rand-post border border-dark">
						<h4 class="post-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h4>
						
					</div>
				
				<?php } //end While
			}  //end If	
			wp_reset_postdata();
			
		?>

	<!-- author -->

	<div class="author-info">
		<div class="row">
			<div class="col-sm-2">
				<?php echo get_avatar(get_the_author_meta('ID'), 128, '', 'user avatar', array(
					'class'    => 'img-responsive img-thumbnail center-block'
				)); ?>
			</div>
			<div class="col-sm-10">
				
				<?php the_author_meta('first_name');  ?>
				<?php the_author_meta('last_name');  ?>
				
				<?php
				if(get_the_author_meta('description')) { ?>
					<p>
					<?php the_author_meta('description'); ?>
					</p>
					<?php
				}else {
					echo "there is no description";
				}

				?>
			</div>
		</div>
		 User Profile: <?php the_author_posts_link(); ?> |
		 User Posts Count: <?php echo count_user_posts(get_the_author_meta('ID')); ?>
	</div>

	<?php comments_template(); ?>
	
</div>	

<?php get_footer(); ?>