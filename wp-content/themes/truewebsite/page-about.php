<?php get_header(); ?>

<section class="about page-margin">	
	<div class="container">
		<div class="about-content">
			<h1 class="special-head"><?php echo get_theme_mod('head_option'); ?></h1>
			<?php echo wpautop(get_theme_mod('text_option')); ?>
		</div>
		<div class="about-img">
			<img src="<?php echo wp_get_attachment_url(get_theme_mod('me_custome_image')); ?>" alt="muhammad eltaher">
		</div>
	</div>
</section>

<?php get_footer(); ?>
