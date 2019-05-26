<?php
/**
 * Template Name: Option
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Patch Emblem 1.0
 */

get_header(); ?>
<div class="whole_pages_pembl">
	<div class="container">
    	<div class="row">
        	<div class="galleryArea clearfix">
    			<?php
    			// Start the loop.
    			while ( have_posts() ) : the_post();
    	
    				the_content();
    	
    			// End the loop.
    			endwhile;
    			?>

				
				<?php
				$option_terms = get_terms( 'option-categories', array(
					'hide_empty'        => false,
					'orderby'           => 'term_id', 
					'order'             => 'ASC'
				) );

				foreach($option_terms as $key => $option_term){
					$order = get_field( 'option_taxonomy_order', $option_term );
			
					$option_terms[$key]->order = $order;
				}

				$option_terms = sort_arr_of_obj($option_terms, 'order');

				//echo '<pre>';print_r($option_terms);die();
				if(count($option_terms) > 0){
					foreach($option_terms as $option_term){
				?>
				
                <div class="photogalleryMainArea">
                <div class="home-first-heading"><h2><?php echo $option_term->name; ?></h2></div>
                <div class="home-option-description"><p><?php echo $option_term->description; ?></p></div>
				<div class="clearfix"></div>
				<?php
				$args = array(
					'order'            => 'ASC',
					'post_type' => 'option',
					'meta_key'         => 'option_category',
					'meta_value'       => $option_term->term_id,
					'posts_per_page' => -1
				);
				$option_posts = get_posts( $args );
				//echo '<pre>';print_r($option_posts);die();
				if(count($option_posts) > 0){
						foreach($option_posts as $option_post){
							$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), medium );
							$full = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), full );
							$description = get_post_meta($option_post->ID, 'short_description', true);
				?>
				
					<div class="col-sm-4 col-lg-4 prtflioAgaiNew">
						<div class="all_conhshd">
							<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/transparentff.jpg" data-lazy-src="<?php echo $full[0]; ?>" data-src="<?php echo $full[0]; ?>" alt="<?php echo $option_post->post_title; ?>">
							</a>
	                        <h5><?php echo $option_post->post_title; ?></h5>
	                        <p><?php echo $description; ?></p>
                        </div>
					</div>
	
				<?php
						}
				}
				?>
</div>
				<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-content">
            <div class="modal-body">
                <img src="" alt="" />
            </div>
        </div>
    </div>
</div>

				<div class="clearfix"></div>
		<?php
					}
		}
		?>
				
    <p>Check out the custom embroidered patch design options and choose the best one for your custom embroidered patch today.</p>
				
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    var $lightbox = $('#lightbox');
    
    $('[data-target="#lightbox"]').on('click', function(event) {
        var $img = $(this).find('img'), 
            src = $img.attr('data-src'),
            alt = $img.attr('alt'),
            css = {
                'maxWidth': $(window).width() - 100,
                /*'maxHeight': $(window).height() - 100*/
            };
    
        $lightbox.find('.close').addClass('hidden');
        $lightbox.find('img').attr('src', src);
        $lightbox.find('img').attr('alt', alt);
        $lightbox.find('img').css(css);
    });
    
    $lightbox.on('shown.bs.modal', function (e) {
        var $img = $lightbox.find('img');
            
        //$lightbox.find('.modal-dialog').css({'width': $img.width()});
        $lightbox.find('.close').removeClass('hidden');
    });
});
</script>
<?php get_footer(); ?>

