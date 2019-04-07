
					<div class="col-sm-4">
						<div class="main-post border border-dark">
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
							
							<?php the_post_thumbnail('', ['class'  => 'img-responsive img-thumbnail', 'title'  => 'post img']); ?>
							<?php

							if(is_search()) { ?>
								<p class="post-content"><?php the_content(); ?>
									<a href="<?php echo get_permalink(); ?>">
									Read More...
									</a>	
								</p>  
							<?php }else { ?>

									<p class="post-content"><?php the_excerpt(); ?>
										<a href="<?php echo get_permalink(); ?>">
										Read More...
										</a>	
									</p>
									<?php }

						 	?>
						
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