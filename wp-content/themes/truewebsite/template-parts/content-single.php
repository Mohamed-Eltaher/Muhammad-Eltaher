<div class="single-post-page">
	<h1 class="special-head"><?php the_title(); ?></h1>		
	<div class="img-container">
		<?php
			the_post_thumbnail();
		?>
	</div>
	<div class="post-content">	
		<span class="date">( <?php the_date(); ?> )</span>
		<?php the_content(); ?>
	</div>
</div>
