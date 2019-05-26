<?php
/**
 * Template Name: Product
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

	<div class="container">
    	<div class="row">
        	<div class="totalPr0ductArea4New arranged">
                <div class="col-md-12 col-sm-12"><h1>Customized Patches for Clothing</h1></div>
                <div class="col-md-3 col-sm-6 accordianArea">
            	<h3 class="small_title">Categories</h3>
				<?php
				$product_terms = get_terms( 'product-categories', array(
					'hide_empty'        => false,
					'orderby'           => 'term_id', 
					'order'             => 'ASC'
				) );

				foreach($product_terms as $key => $product_term){
					$order = get_field( 'taxonomy_order', $product_term );
					$product_terms[$key]->order = $order;
					//echo '<pre>';print_r($order);die();
				}

				//echo '<pre>';print_r($product_terms);//die();

				$product_terms = sort_arr_of_obj($product_terms, 'order');

				//echo '<pre>';print_r($product_terms);die();

				if(count($product_terms) > 0){
				?>
				<ul id="top_ul">
				<?php
					foreach($product_terms as $product_term){
				?>
					<li class="top_li li_<?php echo $product_term->term_id; ?>"><a href="#" data-name="automotive" data-filter=".<?php echo $product_term->slug; ?>"><?php echo $product_term->name; ?></a></li>
				<?php
					}
				?>
				</ul>
				<?php
				}
				?>
				
            </div>
            
			<div class="col-md-9 col-sm-6 productListArea clearfix">
            	<div class="topListArea">
                	<h3>Products </h3>
                </div>
				
				<?php
				if(count($product_terms) > 0){
				?>
				
				<div id="container">
					<?php
					foreach($product_terms as $product_term){
						$full = z_taxonomy_image_url($product_term->term_id);
						$product_title = get_field( 'product_title', $product_term );
						$product_description = get_field( 'full_description_for_product_details_page', $product_term );
						
					?>
					
					<div class="<?php echo $product_term->slug; ?> product-main-inner-right" >
							
							<div class="col-md-12 col-sm-12">
                            	<div class="arranged_sublimation">
								<h3 style="color:#2281a7; margin-bottom:15px;"><?php echo $product_title; ?></h3>
								<?php echo $product_description; ?>
                                </div>
							</div>
                            <div class="col-md-12 col-sm-12 text-center">
								<div class="arranged_productbox"><img width="100%" style="margin-bottom:25px; max-width:450px;" alt="<?php echo $product_title; ?>" src="<?php echo $full; ?>" /></div>
							</div>
                            <div class="clearfix"></div>
						
					</div>
					<div class="clearfix"></div>
				
					<?php
					}
					?>
				</div>
				
				<?php
				}
				?>
				
			</div>	
            </div>
            <div class="clearfix"></div>
		</div>
    </div>
<div class="clearfix"></div>

<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/isotope.pkgd.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function($){
	// init Isotope
	var $container = $('#container').isotope({});
	// filter items on button click
	$('#top_ul').on( 'click', 'a', function() {
	  $('#top_ul').find('li').removeClass('product-active');
          $(this).parent().addClass('product-active');
	  var filterValue = $(this).attr('data-filter');
	  $container.isotope({ filter: filterValue });
	});
	
	var index;
	if (localStorage.getItem('li_id') != '' || localStorage.getItem('li_id') !== undefined) {
		var li_id = localStorage.getItem('li_id');
		index = $('#top_ul > li.li_' + li_id).index();
	}else{
		index = 0;	
	}
	$('#top_ul').find('a').eq(index).trigger('click');
	
});
</script>

<?php get_footer(); ?>

