<?php

// To remove Ver of wp for security
require get_template_directory() . '/inc/cleanup.php';

// For mobile
require get_template_directory().'/inc/vendor/Mobile_Detect.php';

// For contact form
require get_template_directory() . '/inc/ajax.php';


if ( ! function_exists( 'hamo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hamo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on hamo, use a find and replace
		 * to change 'hamo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hamo', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'profLandscape', 400, 260, true );
		add_image_size( 'profPortrait', 480, 650, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'hamo' ),
			'menu-2' => esc_html__( 'Footer', 'hamo' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'hamo_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'max-height'      => 250,
			'max-width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'hamo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hamo_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hamo_content_width', 640 );
}
add_action( 'after_setup_theme', 'hamo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hamo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hamo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hamo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hamo_widgets_init' );


/* filters */

// Enhance Excerpt
function hamo_extend_excerpt_length($length) {
	if(is_author()){
		return 40;
	}elseif(is_category()){
		return 50;
	}else {
		return 40;
	}
}

add_filter('excerpt_length', 'hamo_extend_excerpt_length');

/**
 * Enqueue scripts and styles.
 */
function hamo_scripts() {

	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/style.css', NULL);

	wp_enqueue_style( 'font-awmesome', get_template_directory_uri() . '/sass/all.min.css');

	wp_enqueue_script( 'hamo-jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js", array(), '', true );

	wp_enqueue_script( 'bundle-js', get_template_directory_uri() . '/js/min-js/bundle.min.js', array(), '', true );

	wp_enqueue_script( 'hamo-live', "http://localhost:35729/livereload.js", array(), '', true );

	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//wp_enqueue_style( 'font-awesome', "https://use.fontawesome.com/releases/v5.8.1/css/all.css");
}
add_action( 'wp_enqueue_scripts', 'hamo_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/*
if( wp_is_mobile() ) {

	function my_filter_head() {
	   remove_action('wp_head', '_admin_bar_bump_cb');
	}

	add_action('get_header', 'my_filter_head');

} 
*/


/* Events custome its main Query */

function hamo_adjust_queries($query) {
	if( !is_admin() AND is_post_type_archive('course') AND $query->is_main_query()) {
		$today = date('Ymd');
		$query->set('meta_key', 'course_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(
			array(
				'key'     => 'course_date',
	 			'compare' => '<',
	 			'value'   => $today,
	 			'type'    => 'numeric'
			)
		));
	}
}

add_Action('pre_get_posts', 'hamo_adjust_queries');


// function to add active class to cureent menu item
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}



// Redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend() {
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}

// Customize Login Screen

add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() {
  wp_enqueue_style( 'hamo-style', get_template_directory_uri() . '/sass/main.css' );
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
  return get_bloginfo('name');
}


/*
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/me.png);
		height:65px;
		width:320px;
		background-size: 320px 65px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
*/
/*
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );

function remove_jquery_migrate( &$scripts){
    if(!is_admin()){
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.2.1' );
    }
}
*/
// Website speed optimization
/*
function defer_parsing_of_js ( $url ) {
  if ( FALSE === strpos( $url, '.js' ) ) return $url;
  if ( strpos( $url, 'jquery.js' ) ) return $url;
    return "$url' defer ";
}
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 ); 
*/
// remove gutenberg css
function wpassist_remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
} 
add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css' );


// remove emoji script
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// remove wp-embed that used to embed posts from other websites
function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

// function to make media library support webp next gen images

/**
 * Sets the extension and mime type for .webp files.
 *
 * @param array  $wp_check_filetype_and_ext File data array containing 'ext', 'type', and
 *                                          'proper_filename' keys.
 * @param string $file                      Full path to the file.
 * @param string $filename                  The name of the file (may differ from $file due to
 *                                          $file being in a tmp directory).
 * @param array  $mimes                     Key is the file extension with value as the mime type.
 */
add_filter( 'wp_check_filetype_and_ext', 'wpse_file_and_ext_webp', 10, 4 );
function wpse_file_and_ext_webp( $types, $file, $filename, $mimes ) {
    if ( false !== strpos( $filename, '.webp' ) ) {
        $types['ext'] = 'webp';
        $types['type'] = 'image/webp';
    }

    return $types;
}

/**
 * Adds webp filetype to allowed mimes
 * 
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
 * 
 * @param array $mimes Mime types keyed by the file extension regex corresponding to
 *                     those types. 'swf' and 'exe' removed from full list. 'htm|html' also
 *                     removed depending on '$user' capabilities.
 *
 * @return array
 */
add_filter( 'upload_mimes', 'wpse_mime_types_webp' );
function wpse_mime_types_webp( $mimes ) {
    $mimes['webp'] = 'image/webp';

  return $mimes;
}


// WooCommerce functions

// declaring woocommerce support
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
	) );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// remove ralated products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// remove adational info tap
add_filter( 'woocommerce_product_tabs', 'my_custom_tabs_function' );

function my_custom_tabs_function($tabs) {
	unset($tabs['additional_information']);
	return $tabs;
}

// remove desc tap
add_filter( 'woocommerce_product_tabs', 'my_custom_desc_function' );

function my_custom_desc_function($desc) {
	unset($desc['description']);
	return $desc;
}

// theme woocommerce support
add_action( 'after_setup_theme', 'bctheme_setup' );

function bctheme_setup() {
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}

// changing desc location
add_filter('woocommerce_single_product_summary', 'description', 70);

function description() {
	the_content();
}

// remove review gravatar
remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );

// use this if you want to change add to cart text
 add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text');

function woo_custom_single_add_to_cart_text() {
	return __('buy now', 'woocommerce');
} 

//removing breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// removing SKU, categ, ..
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// add numeric rating
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_single_rating', 5);

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// checkout cart

add_action( 'woocommerce_after_checkout_form', 'bbloomer_cart_on_checkout_page_only', 5 );
 
function bbloomer_cart_on_checkout_page_only() {
 
echo do_shortcode('[woocommerce_cart]');

}

// print your logo on checkout page
add_action( 'woocommerce_before_checkout_form_cart_notices', "mylogo" );

function mylogo() {
	echo "<h1 class='checkout-logo'>BodyCheers</h1>";
}

// Custome checkout fields
add_filter('woocommerce_default_address_fields', 'override_default_address_checkout_fields', 20, 1);
function override_default_address_checkout_fields( $address_fields ) {
    $address_fields['first_name']['placeholder'] = 'First Name';
    $address_fields['last_name']['placeholder'] = 'Last Name';
    $address_fields['address_1']['placeholder'] = 'Street address [House number and street name]';
    $address_fields['state']['placeholder'] = 'State / Country';
    $address_fields['postcode']['placeholder'] = 'Postcode / ZIP';
    $address_fields['city']['placeholder'] = 'City';
    return $address_fields;
}

add_filter( 'woocommerce_checkout_fields' , 'override_billing_checkout_fields', 20, 1 );
function override_billing_checkout_fields( $fields ) {
    //$fields['billing']['billing_phone']['placeholder'] = 'Telefon';
    $fields['billing']['billing_email']['placeholder'] = 'Email';
    return $fields;
}



// WooCommerce Checkout Fields Hook
add_filter('woocommerce_checkout_fields','custom_wc_checkout_fields_no_label');

// Our hooked in function - $fields is passed via the filter!
// Action: remove label from $fields
function custom_wc_checkout_fields_no_label($fields) {
    // loop by category
    foreach ($fields as $category => $value) {
        // loop by fields
        foreach ($fields[$category] as $field => $property) {
            // remove label property
            unset($fields[$category][$field]['label']);
        }
    }
     return $fields;
}


/**
 * @snippet       Plus Minus Quantity Buttons @ WooCommerce Single Product Page
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=90052
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.1
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
// -------------
// 1. Show Buttons
 
add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_display_quantity_plus' );
 
function bbloomer_display_quantity_plus() {
   echo '<button type="button" class="plus" >+</button>';
}
 
add_action( 'woocommerce_after_add_to_cart_quantity', 'bbloomer_display_quantity_minus' );
 
function bbloomer_display_quantity_minus() {
   echo '<button type="button" class="minus" >-</button>';
}
 
// -------------
// 2. Trigger jQuery script
 
add_action( 'wp_footer', 'bbloomer_add_cart_quantity_plus_minus' );
 
function bbloomer_add_cart_quantity_plus_minus() {
   // Only run this on the single product page
   if ( ! is_product() ) return;
   ?>
      <script type="text/javascript">
          
      jQuery(document).ready(function($){   
          
         $('form.cart').on( 'click', 'button.plus, button.minus', function() {
 
            // Get current quantity values
            var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
 
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
             
         });
          
      });
          
      </script>
   <?php
}


/**
 * @snippet       “Secure payments” image @ Checkout Page
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=111758
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.4
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
add_action( 'woocommerce_review_order_after_submit', 'bbloomer_trust_place_order' );
  
function bbloomer_trust_place_order() {
    echo '<img src="https://www.paypalobjects.com/digitalassets/c/website/marketing/na/us/logo-center/9_bdg_secured_by_pp_2line.png" style="margin: 1em auto">';
}


/**
 * @snippet       Automatically Update Cart on Quantity Change - WooCommerce
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=73470
 * @author        Rodolfo Melogli
 * @compatible    Woo 3.5.1
 */
 
add_action( 'wp_footer', 'bbloomer_cart_refresh_update_qty' ); 
 
function bbloomer_cart_refresh_update_qty() { 
   if (is_cart()) { 
      ?> 
      <script type="text/javascript"> 
         jQuery('div.woocommerce').on('click', 'input.qty', function(){ 
            jQuery("[name='update_cart']").trigger("click"); 
         }); 
      </script> 
      <?php 
   } 
}



/**
* @snippet   Change autofocus field @ WooCommerce Checkout
* @how-to   Watch tutorial @ https://businessbloomer.com/?p=19055
* @sourcecode   https://businessbloomer.com/?p=
* @author   Rodolfo Melogli
* @testedwith   WooCommerce 3.3.4
*/
 
add_filter( 'woocommerce_checkout_fields', 'bbloomer_change_autofocus_checkout_field' );
 
function bbloomer_change_autofocus_checkout_field( $fields ) {
//$fields['billing']['billing_first_name']['autofocus'] = true;
$fields['billing']['billing_email']['autofocus'] = true;
return $fields;
}




/**
 * @snippet       Move / ReOrder Fields @ Checkout Page, WooCommerce version 3.0+
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=19571
 * @author        Rodolfo Melogli
 * @compatible    Woo 3.5.3
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
add_filter( 'woocommerce_billing_fields', 'bbloomer_move_checkout_email_field', 10, 1 );
 
function bbloomer_move_checkout_email_field( $address_fields ) {
    $address_fields['billing_email']['priority'] = 5;
    return $address_fields;
}