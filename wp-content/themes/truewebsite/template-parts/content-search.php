<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hamo
 */

?>
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
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>
