<div class="single-post-page">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title special-head"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		</header><!-- .entry-header -->

		<div class="img-container">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>

		<div class="post-content">	
			<span class="date"><?php the_date(); ?></span>
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="read-more">read more</a>
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>
<hr>
