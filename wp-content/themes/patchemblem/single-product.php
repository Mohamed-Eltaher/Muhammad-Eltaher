<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header('productdetails'); ?>

<div class="whole_pages_pembl">
<div class="container">
    	<div class="row">
			
			<?php
			while ( have_posts() ) : the_post();
			?>
			
        	<div class="productDetailArea clearfix">
            	<h2>Product Details</h2>
                <div class="col-md-4 col-sm-6">
                	<?php twentyfifteen_post_thumbnail(); ?>
                </div>
                <div class="col-md-8 col-sm-6">
                	<h3><?php the_title(); ?></h3>
                    <?php the_content(); ?>
                </div>
            </div>
			
			<?php
			endwhile;
			?>
			
        </div>
    </div>
</div>





<?php get_footer(); ?>
