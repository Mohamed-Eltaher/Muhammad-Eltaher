<div class="single-post">		
	<div class="img-container">
		<?php
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

		echo '<a href="' . get_the_permalink() .'" class="post-img" style="background-image: url('. $url.')"></a>';
		?>

	</div>
	<div class="post-content">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="post-info">
			<?php hamo_posted_on(); ?>
			<?php hamo_posted_by(); ?>
		</div>
		<?php the_excerpt(); ?>
		<a href="<?php the_permalink(); ?>" class="read-more">read more</a>
		<div class="entry-footer">
			<?php hamo_entry_footer(); ?>
		</div>
	</div>
</div>
