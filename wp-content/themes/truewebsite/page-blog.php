<?php
/*
Step-by-step:
Create front-page.php as your custom front-page template
Create home.php as your blog posts index page template
Leave index.php alone
Create two static pages, of any name; e.g. "Front Page" and "Blog"
Go to Dashboard -> Settings -> Reading
Set Front Page Displays to a static page
Set Front page dropdown to "Front Page" static page created in step 4
Set Posts page dropdown to "Blog" static page created in step 4
*/
?>
<?php get_header(); ?>

<!-- Blog Section -->
<section class="bloge">
	<div class="container">	
		<div class="blog-content blog-page-content">
			<h1 class="blog-head special-head">BLOG</h1>
			<p>That was many years ago and a lot has happened since then. I now get to do what I love every day. I get to write books that mean something to me, and I get to share my thoughts on this blog. I get to interview really incredible people on my top-10 rated podcast, “The James Altucher Show.” I contribute articles to sites like The Wall Street Journal, Yahoo! Finance, and Business Insider.
			</p>
		</div>

		<div id="primary" class="content-area">
			<main id="main" class="site-main site-blog">		
				<?php if(have_posts()) {
					?>
					<div class="blog-posts">
						<?php
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
						$args = array(
							'posts_per_page' => 5,
							'paged' => $paged,

						); 
						$the_query = new WP_Query( $args );
						query_posts('post_type=post');
						while($the_query->have_posts()) {
							$the_query->the_post();
							get_template_part('content', get_post_format());

						} ?>
					</div>
					<span class="page-nav">
						<?php 
						previous_posts_link();
						next_posts_link( 'Next Page', $the_query->max_num_pages);
						?>
					</span>
				<?php } ?>
			</main>
		</div>
	</div>
</section>

<?php get_footer(); ?>