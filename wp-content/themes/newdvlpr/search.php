<?php get_header(); ?>

<div class="container">

	<h2>Search results for:<?php the_search_query(); ?></h2>
	<div class="row">
		<?php
			if(have_posts()){

				while(have_posts()) {

					the_post(); 

					get_template_part( 'content', get_post_format());

				 } //end While
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

	echo paginate_links();
	?>

</div>	

<?php get_footer(); ?>