<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen', get_template_directory() . '/languages' );

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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Header Contact Area', 'twentyfifteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your header.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Copyright Area', 'twentyfifteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Bottom Banner Message Area', 'twentyfifteen' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Add widgets here to appear at bottom of your banner area.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Social Icons Area', 'twentyfifteen' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
    //wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-1.11.3.min.js', array(), '', true );
    //wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '', true );
    
    //wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', array(), '', true );
   
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Custom added hooks
 */
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_filter( 'the_content', 'replace_site_url_from_content', 10, 3 );
function replace_site_url_from_content( $content ) {
    	$template_url = esc_url( get_template_directory_uri() ) . '/';
   	$content = str_replace('[SITE_URL]', $template_url, $content);
    	//$content = nl2br($content);
	return $content;
}

add_filter( 'admin_print_footer_scripts', 'add_menu_hide_js', 10, 3);
function add_menu_hide_js(){
	echo "<script>
	jQuery(document).ready(function(){
		jQuery('#menu-posts-product').find('a').eq(0).attr('href','#');		
		jQuery('#menu-posts-product').find('ul').find('li').eq(1).remove();
		jQuery('#menu-posts-product').find('ul').find('li').eq(1).remove();
	});
	</script>";
}

add_action( 'admin_init', 'hide_editor' );

function hide_editor() {
  // Get the Post ID.
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;

  // Hide the editor on the page titled 'Homepage'
  $homepgname = get_the_title($post_id);
  if($homepgname == 'Product Details'){ 
    remove_post_type_support('page', 'editor');
    remove_post_type_support('page', 'page-attributes');
    remove_post_type_support('page', 'thumbnail');
  }
}


function sort_arr_of_obj($array, $sortby) {

    $sortedArr = array();
    $tmp_Array = array();

    foreach($array as $k => $v) {
        $tmp_Array[] = strtolower($v->$sortby);
    }

    asort($tmp_Array);

    foreach($tmp_Array as $k=>$tmp){
        $sortedArr[] = $array[$k];
    }

    return $sortedArr;

}

function patch_emblem_form_func() {

$output .='<form id="patch_emblem_form" name="patch_emblem_form" class="section-spacing" method="POST" action="'.get_site_url().'/processing/">
        <h2>Payment Form </h2>
        <p style="font-style: italic; font-size: 15px; padding-bottom:10px;"> Required fields are marked with an asterisk (<span style="color: red;">*</span>).</p>
        <div class="payment-form">
        <div class="form-row">
            <div class="form-group">
                <label for="inputfullname" class="col-form-label">Full Name <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="inputfullname" name="full_name" placeholder="Please Enter Your Full Name" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="inputemail" class="col-form-label">Email <span style="color: red;">*</span></label>
                <input type="email" class="form-control" id="inputemail" name="email" placeholder="Please Enter Your Email" required>
            </div>
            <p style="margin-bottom: 10px;"><small>Please use same email address used to require quote.</small></p>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="extra_notes">Extra Notes</label>
                <textarea class="form-control" id="extra_notes" name="extra_notes" rows="3" placeholder="Please Enter Extra Notes"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="street_address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Please Enter Your Full Address"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="inputphonenumber" class="col-form-label">Phone Number</label>
                <input type="tel" class="form-control" id="inputphonenumber" name="phone_number" placeholder="Please Enter Phone Number">
            </div>
        </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field deposit">
                <label class="form-check-label">Enter Amount US$ <span style="color: red;">*</span></label>
                <input type="number" class="form-control" id="payment_type" name="deposited_amount" placeholder="Please Enter Amount" required>                
            </div>
        </div> 
        <div class="payment_budgyd"><input type="submit" class="btn btn-primary" name="submit" value="submit"></input></div>
    </form>'; 
?>
<!-- <script type="text/javascript">
 jQuery(document).ready(function(){
        var $radios = jQuery('.radio input#payment_method');
        if($radios.is(':checked') === false) {
            $radios.filter('[value=deposit]').prop('checked', true);
            jQuery(".fullpayment").hide();
            jQuery(".partialpayment").hide();
            jQuery('#payment_type_full').prop('required',false);
            jQuery('#deposited_order_id').prop('required',false);
            jQuery('#payment_type_partial').prop('required',false);
        }
        jQuery('.radio input[type="radio"]').click(function(){
            var inputValue = jQuery(this).attr("value");            
            var targetBox = jQuery("." + inputValue);
            //console.log(targetBox);
            if( inputValue == 'deposit' ){
                jQuery(targetBox).find('input').prop('required','required');
                jQuery('.fullpayment').find('input').prop('required',false);
                jQuery('.partialpayment').find('input').prop('required',false);
                jQuery(".payment-form").find('input').prop('required',true);
                jQuery(".payment-form").show();
            }else if(inputValue == 'fullpayment'){
                jQuery(targetBox).find('input').prop('required','required');
                jQuery('.deposit').find('input').prop('required',false);
                jQuery('.partialpayment').find('input').prop('required',false);
                jQuery(".payment-form").find('input').prop('required',true);
                jQuery(".payment-form").show();
            }else{
                jQuery(targetBox).find('input').prop('required','required');
                jQuery('.deposit').find('input').prop('required',false);
                jQuery('.fullpayment').find('input').prop('required',false);
                jQuery(".payment-form").find('input').prop('required',false);
                jQuery("#address").prop('required',false);                
                jQuery(".payment-form").hide();
            }
            jQuery(".input-field").not(targetBox).hide();
            jQuery(targetBox).show();
        });       
});
</script> -->
<?php
return $output;
}
add_shortcode( 'patch_emblem_form', 'patch_emblem_form_func' );


add_action('paypal_ipn_for_wordpress_ipn_response_handler', 'paypal_cus_ipn', 9, 1);
     function paypal_cus_ipn($posted) {
    
     if($posted['custom'] != ''){
        $payment_status = isset($posted['payment_status']) ? $posted['payment_status'] : '';
        $ord_id = trim($posted['custom']);
        $full_name = get_field( "full_name", $ord_id );
        $email = get_field( "email", $ord_id );
        $extra_notes = get_field( "extra_notes", $ord_id );
        $address = get_field( "address", $ord_id );
        $phone_number = get_field( "phone_number", $ord_id );
        $deposited_amount = get_field( "deposited_amount", $ord_id );

        
            //valued fetch from order post
            $email = get_field( "email", $ord_id );
            $full_name = get_field( "full_name", $ord_id );
            $extra_notes = get_field( "extra_notes", $ord_id );
            $address = get_field( "address", $ord_id );
            $phone_number = get_field( "phone_number", $ord_id );
            $deposited_amount = get_field( "deposited_amount", $ord_id );
            
            //Email to admin and user from here
            $headers[] = 'From: Patch Emblem <sales@patch-emblem.com>';
            $message = 'Dear '.$full_name.', <br /> <br />Thank you for your Order.<br />';
            $message .='<h2>Here are the order Details</h2>';
            $message .= 'Payment Status: ' . $payment_status . "\n";
            $message .='<table id="content" style="margin-top: 10px; color: #444; line-height: 1.6; font-size: 12px; font-family: Arial, sans-serif;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff"><tbody>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td colspan="2"><div style="padding-top: 15px; padding-bottom: 1px; font-weight: bold; color: #000;">Full Name</div><div style="color: #000;">'.$full_name.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Email</div><div style="color: #000;">'.$email.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Extra Notes</div><div style="color: #000;">'.$extra_notes.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Address</div><div style="color: #000;">'.$address.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Phone Number</div><div style="color: #000;">'.$phone_number.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Amount</div><div style="color: #000;">'.$deposited_amount.'</div></td></tr>';
            $message .='</tbody></table><br /> Regards, <br /> Patch Emblem Team';
            
            // wp mail function for admin and user for Deposit payment option
            wp_mail( $email, 'Patch Emblem Payment Order', $message,$headers  );
            
            $admin_email = get_option( 'admin_email' );
            // admin Message html
            $admin_message = 'Dear Admin, <br /> <br />'.$full_name.' done payment on Patch Emblem payment.<br />';
            $admin_message .='<h2>Here are the order Details For '.$full_name.'</h2>';
            $admin_message .='<table id="content" style="margin-top: 10px; color: #444; line-height: 1.6; font-size: 12px; font-family: Arial, sans-serif;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff"><tbody>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td colspan="2"><div style="padding-top: 15px; padding-bottom: 1px; font-weight: bold; color: #000;">Full Name</div><div style="color: #000;">'.$full_name.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Email</div><div style="color: #000;">'.$email.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Extra Notes</div><div style="color: #000;">'.$extra_notes.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Address</div><div style="color: #000;">'.$address.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Phone Number</div><div style="color: #000;">'.$phone_number.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Deposit Amount</div><div style="color: #000;">'.$deposited_amount.'</div></td></tr>';
            $admin_message .='</tbody></table>';
            
            wp_mail( $admin_email, 'Patch Emblem Payment Order', $admin_message, $headers );
       
    }
    
    function wmpudev_enqueue_icon_stylesheet() {
    	// wp_register_style( 'fontawesome', 'https:////maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
    	//wp_enqueue_style( 'fontawesome');
    	wp_register_style( 'custom-style', get_template_directory_uri().'/css/custom.css' );
    	wp_enqueue_style( 'custom-style');
    }
    add_action( 'wp_enqueue_scripts', 'wmpudev_enqueue_icon_stylesheet' );
}
function defer_parsing_of_js ( $url ) {
if ( FALSE === strpos( $url, '.js' ) ) return $url;
if ( strpos( $url, 'jquery.js' ) ) return $url;
return "$url' defer ";
}
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
