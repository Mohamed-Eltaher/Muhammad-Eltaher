<?php
/**
 * Display Home Page
 * @package hamo
 */

get_header(); ?>

<section class="custome-header">
	<img alt="" style=" background-image:url('<?php header_image(); ?>')" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>">
	
	<!--<video autoplay loop id="video-background" muted plays-inline>
		<source src="<?php //echo wp_get_attachment_url(get_theme_mod('video_option')); ?>" type="video/mp4">
	</video> -->
		
	<div class="intro">
		<h2>Hi, I'm Muhammad</h2>
		<h2>An Experienced WordPress Developer.</h2>
	</div>

</section> 

<!-- Blog Section -->
<section class="bloge">
	<div class="container">
		<h1 class="blog-head">LATEST POSTS</h1>		
		<?php if(have_posts()) { ?>
			<div class="blog-posts">
				<?php 
				query_posts('post_type=post');
				while(have_posts()) {
					the_post();
					get_template_part('content', get_post_format());
				} ?>
			</div>
		<?php } ?>
	</div>
</section>

<!-- projects Section -->
<?php
$today = date('Ymd');
$mainProjects = new WP_Query(array(
	'post_type'  => 'project',
	'meta_key'   => 'project_date',
	'orderby'    => 'meta_value_num',
	'order'      =>'ASC',
	'meta_query' => array(
		array(
			'key'     => 'project_date',
			'compare' => '>=',
			'value'   => $today,
			'type'    => 'numeric'
		)
	)
));

if($mainProjects->have_posts()) { ?>
<section class="bloge projects">
	<div class="container page-margin">
		<h1 class="blog-head">Latest Projects</h1>
		<div class="blog-posts">
			<?php 
			while($mainProjects->have_posts()) {
				$mainProjects->the_post(); ?>
				<div class="single-post">				
					<div class="post-content">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php the_excerpt(); ?>
						
						<div class="know-more">Project Date <?php the_field('project_date'); ?></div>
						<div class="entry-footer">
							<?php hamo_entry_footer(); ?>
						</div>
					</div>
				</div>		
			<?php } ?>
		</div>
		<?php } ?>
	</div>
</section>


<?php get_footer(); ?>