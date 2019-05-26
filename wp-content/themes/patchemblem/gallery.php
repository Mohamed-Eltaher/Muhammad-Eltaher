<?php
/**
 * Template Name: Gallery
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
                <p>
					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();
			
						the_content();
			
					// End the loop.
					endwhile;
					?>
				</p>			
				
				<?php
					$option_terms = get_terms( 'gallery-categories', array(
						'hide_empty'        => false, 
					) );

					foreach($option_terms as $key => $option_term){
						$order = get_field( 'gallery_taxonomy_order', $option_term );
						$option_terms[$key]->order = $order;
					}

					$option_terms = sort_arr_of_obj($option_terms, 'order');

					if(is_page('gallery')){
						//echo '<pre>';print_r($option_terms);die();
						if(count($option_terms) > 0){
							foreach($option_terms as $option_term){
							    if($option_term->name != "Military Patches" && $option_term->name != "Biker Patches"){
				?>
					
	                <div class="photogalleryMainArea">
	                <div class="home-first-heading"><h2><?php echo $option_term->name; ?></h2></div>
					<div class="clearfix"></div>
					<?php
					$count_post = 0;
					$count_ex = 0;
					$args = array(
						'order'            => 'ASC',
						'post_type' => 'gallery',
						'meta_key'         => 'gallery_category',
						'meta_value'       => $option_term->term_id,
						'posts_per_page' => -1
					);
					$option_posts = get_posts( $args );
					//ssecho '<pre>';print_r($option_post->post_title);die('----');
					if(count($option_posts) > 0){

						foreach($option_posts as $option_post){
							$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), medium );
							$full = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), full );

							$count_post++;
							$count_ex++;
							if($count_post == 1){
								echo'<div class="row">';
							}
					?>
					
					<div class="col-xs-12 col-sm-3 col-md-3 text-center">
						<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
							<img page_title="<?php echo $option_post->post_title; ?>" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/transparentfs.jpg" data-lazy-src="<?php echo $full[0]; ?>" data-src="<?php echo $full[0]; ?>" alt="<?php echo $option_post->post_title; ?>">
						</a>
						<!-- <h4><?php //echo $option_post->post_title; ?></h4> -->
					</div>
		
					<?php
					if($count_post == 4 || $count_ex == count($option_posts) ){
								echo'</div>';
								$count_post = 0;
							}
						}
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
					}elseif(is_page('custom-biker-patches')){
					    	if(count($option_terms) > 0){
							foreach($option_terms as $option_term){
				
							if($option_term->slug == 'custom-biker-patches'){
                				echo '<div class="photogalleryMainArea">';
                				echo '<div class="home-first-heading"><h2>'.$option_term->name.'</h2></div>';
								echo '<div class="clearfix"></div>';
					
								$args = array(
									'order'            => 'ASC',
									'post_type' => 'gallery',
									'meta_key'         => 'gallery_category',
									'meta_value'       => $option_term->term_id,
									'posts_per_page' => -1
								);
								$option_posts = get_posts( $args );
								//echo '<pre>';print_r($option_posts);die();
								if(count($option_posts) > 0){
										foreach($option_posts as $option_post){	
											$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), medium );
											$full = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), full );
						?>
						
								<div class="col-xs-12 col-sm-3 col-md-2 text-center">
									<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
										<img src="<?php echo $thumbnail[0]; ?>" data-src="<?php echo $full[0]; ?>" alt="<?php echo $option_post->post_title; ?>">
									</a>
								<h4><?php echo $option_post->post_title; ?></h4>
								</div>
			
				<?php
									}
								}
							}
							}
						}

					    
					}elseif(is_page('custom-military-patches')){
					    	if(count($option_terms) > 0){
							foreach($option_terms as $option_term){
				
							if($option_term->slug == 'custom-military-patches'){
                				echo '<div class="photogalleryMainArea">';
                				echo '<div class="home-first-heading"><h2>'.$option_term->name.'</h2></div>';
								echo '<div class="clearfix"></div>';
					
								$args = array(
									'order'            => 'ASC',
									'post_type' => 'gallery',
									'meta_key'         => 'gallery_category',
									'meta_value'       => $option_term->term_id,
									'posts_per_page' => -1
								);
								$option_posts = get_posts( $args );
								//echo '<pre>';print_r($option_posts);die();
								if(count($option_posts) > 0){
										foreach($option_posts as $option_post){	
											$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), medium );
											$full = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), full );
						?>
						
								<div class="col-xs-12 col-sm-3 col-md-2 text-center">
									<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
										<img src="<?php echo $thumbnail[0]; ?>" data-src="<?php echo $full[0]; ?>" alt="<?php echo $option_post->post_title; ?>">
									</a>
								<h4><?php echo $option_post->post_title; ?></h4>
								</div>

			
				<?php
									}
								}
							}
							}
						}

					    
					}elseif(is_page('woven-patches')){
						
					    	if(count($option_terms) > 0){
							foreach($option_terms as $option_term){
					 		
							if($option_term->slug == 'woven_patches'){
                				echo '<div class="photogalleryMainArea">';
                				echo '<div class="home-first-heading"><h2>'.$option_term->name.'</h2></div>';
								echo '<div class="clearfix"></div>';
								$args = array(
									'order'            => 'ASC',
									'post_type' => 'gallery',
									'meta_key'         => 'gallery_category',
									'meta_value'       => $option_term->term_id,
									'posts_per_page' => -1
								);
								$option_posts = get_posts( $args );
								//echo '<pre>';print_r($option_posts);die();
								if(count($option_posts) > 0){
										foreach($option_posts as $option_post){	
											$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), medium );
											$full = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), full );
						?>
						
								<div class="col-xs-12 col-sm-3 col-md-2 text-center">
									<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
										<img src="<?php echo $thumbnail[0]; ?>" data-src="<?php echo $full[0]; ?>" alt="<?php echo $option_post->post_title; ?>">
									</a>
								<h4><?php echo $option_post->post_title; ?></h4>
								</div>

								<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				   	 			<div class="modal-dialog">
				        			<button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
				        			<div class="modal-content">
				            		<div class="modal-body img_size">
				                		<img src="" alt="" />
				            		</div>
				        			</div>
							    </div>
								</div>
			
				<?php
									}
								}
							}
							}
						}

					    
					}elseif(is_page('chenille-emblems')){

					    	if(count($option_terms) > 0){
							foreach($option_terms as $option_term){
								
					 		
							if($option_term->slug == 'chenille-emblems'){
                				echo '<div class="photogalleryMainArea vhfhf">';
                				echo '<div class="home-first-heading"><h2>'.$option_term->name.'</h2></div>';
								echo '<div class="clearfix"></div>';
								$args = array(
									'order'            => 'ASC',
									'post_type' => 'gallery',
									'meta_key'         => 'gallery_category',
									'meta_value'       => $option_term->term_id,
									'posts_per_page' => -1
								);
								$option_posts = get_posts( $args );
								//echo '<pre>';print_r($option_posts);die();
								if(count($option_posts) > 0){
										foreach($option_posts as $option_post){	
											$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), medium );
											$full = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), full );
						?>
						
								<div class="col-xs-12 col-sm-3 col-md-2 text-center">
									<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
										<img src="<?php echo $thumbnail[0]; ?>" data-src="<?php echo $full[0]; ?>" alt="<?php echo $option_post->post_title; ?>">
									</a>
								<h4><?php echo $option_post->post_title; ?></h4>
								</div>
								<div id="lightbox" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				   	 			<div class="modal-dialog">
				        			<button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
				        			<div class="modal-content">
				            		<div class="modal-body img_size ">
				                		<img src="" alt="" />
				            		</div>
				        			</div>
							    </div>
								</div>

				<?php
									}
								}
							}
							}
						}

					    
					}else{
						if(count($option_terms) > 0){
							foreach($option_terms as $option_term){
				
							if($option_term->slug == 'embroidered-patches'){
                				echo '<div class="photogalleryMainArea">';
                				echo '<div class="home-first-heading"><h2>'.$option_term->name.'</h2></div>';
								echo '<div class="clearfix"></div>';
					
								$args = array(
									'order'            => 'ASC',
									'post_type' => 'gallery',
									'meta_key'         => 'gallery_category',
									'meta_value'       => $option_term->term_id,
									'posts_per_page' => 12
								);
								$option_posts = get_posts( $args );
								//echo '<pre>';print_r($option_posts);die();
								if(count($option_posts) > 0){
										foreach($option_posts as $option_post){	
											$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), medium );
											$full = wp_get_attachment_image_src( get_post_thumbnail_id($option_post->ID), full );
						?>
						
								<div class="col-xs-12 col-sm-3 col-md-2 text-center">
									<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
										<img src="<?php echo $thumbnail[0]; ?>" data-src="<?php echo $full[0]; ?>" alt="<?php echo $option_post->post_title; ?>">
									</a>
								<h4><?php echo $option_post->post_title; ?></h4>
								</div>
			
				<?php
									}
								}
							}
							}
						}
						?>
					<p class="page-style">Check out the above designs requests and get a free quote as our creative specialists will be on your beck and call to showcase thousands of special options that suit your needs. We will make sure that the patches will look amazing anywhere you choose to wear them.</p>
<?php
					}
		?>
				
                
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    var $lightbox = $('#lightbox');
    

    $('[data-target="#lightbox"]').on('click', function(event) {
    	var cls = $('.modal-body').hasClass('img_size');
    	console.log(cls);
    	if(cls == false){
    		var $img = $(this).find('img'), 
            src = $img.attr('data-src'),
            alt = $img.attr('alt'),
			css = {
				    'maxWidth': $(window).width() - 100,
				    /*'maxHeight': $(window).height() - 100*/
				};
        	
    	}else{
    		var $img = $(this).find('img'), 
            src = $img.attr('data-src'),
            alt = $img.attr('alt'),
            css = {
				    'maxWidth': $(window).width() - 100,
				    'maxHeight': $(window).height() - 100 +'%'
				};
		}
           
    
        $lightbox.find('.close').addClass('hidden');
        $lightbox.find('img').attr('src', src);
        $lightbox.find('img').attr('alt', alt);
        $lightbox.find('img').css(css);
 
    });
    
    $lightbox.on('shown.bs.modal', function (e) {
        var $img = $lightbox.find('img');
            //alert($img.width());
        //$lightbox.find('.modal-dialog').css({'width': $img.width()});
        $lightbox.find('.close').removeClass('hidden');
    });
});
</script>
<?php get_footer(); ?>

