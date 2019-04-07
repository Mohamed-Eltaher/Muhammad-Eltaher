<?php get_header(); ?>

<div class="container">
	<div class="author-info author-meta">
		<div class="row">
			<div class="col-sm-2">
				<?php echo get_avatar(get_the_author_meta('ID'), 196, '', 'user avatar', array(
					'class'    => 'img-responsive img-thumbnail center-block'
				)); ?>
			</div>
			<div class="col-sm-10">
				First Name:
				<?php the_author_meta('first_name');  ?> </br>
				Last Name:
				<?php the_author_meta('last_name');  ?> </br>
				
				Description:
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
		 User Posts Count: <?php echo count_user_posts(get_the_author_meta('ID')); ?> |
		 User comments Count: <?php echo get_comments(array(
		 	'user_id'  => get_the_author_meta('ID'),
		 	'count'   => true
		 )) ?>

	</div>
	<div class="author-posts">
		<div class="row">
	
			<?php

			$custom_posts_number = new WP_Query(array(

				'author'   => get_the_author_meta('ID'),
				'posts_per_page'   => -1

			));
				

			if($custom_posts_number->have_posts()){ ?>
				
					<?php while($custom_posts_number->have_posts()) { ?>
						
					<?php $custom_posts_number->the_post(); ?>
					
						<div class="col-sm-2">
							<?php the_post_thumbnail('', ['class'  => 'img-responsive img-thumbnail', 'title'  => 'post img']); ?>
						</div>

						<div class="col-sm-10">
							<div class="author-main border border-dark">
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
								
								
								<p class="post-content"><?php the_excerpt(); ?>
								<a href="<?php echo get_permalink(); ?>">Read More...</a>	
								</p>
								
							</div>
						
					</div>

					<?php } //end While
				}  //end If	
				wp_reset_postdata();

				
			?>
		</div>

		<?php

			// get latest comments by author

				$comments_per_page = 10; ?>
				<h4 class="text-center">
				Latest <?php echo $comments_per_page ?> comments By
				<?php the_author_meta('first_name') ?>
				</h4> <br>
				<?php
				$comments = get_comments(array(
					'user_id'     => get_the_author_meta('ID'),
					'status'      => 'approve',
					'number'      => $comments_per_page,
					'post_status' => 'publish',
					'post_type'   => 'post'

				));

				foreach ($comments as $comment) {
					if($comments) { ?>
				    <a href="<?php the_permalink($comment->comment_post_ID) ?>">
					<?php	
						echo "<div class='comment'>";
							echo get_the_title($comment->comment_post_ID) . "<br>";
							echo "</a>";
							echo $comment->comment_date . "<br>";
							echo $comment->comment_content . "<br>";
						echo "</div>";
				}
			else {
					echo "sorry, there are no comments here";
				}
			}
		?>
	</div>
</div>

<?php get_footer(); ?>