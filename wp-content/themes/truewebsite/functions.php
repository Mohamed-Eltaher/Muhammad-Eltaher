<?php
/**
 * hamo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hamo
 */


// To remove Ver of wp for security
require get_template_directory() . '/inc/cleanup.php';

// For mobile
require get_template_directory().'/inc/vendor/Mobile_Detect.php';


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
			'height'      => 250,
			'width'       => 250,
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
	return 25;
	}
}

add_filter('excerpt_length', 'hamo_extend_excerpt_length');

/**
 * Enqueue scripts and styles.
 */
function hamo_scripts() {

	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/style.css', NULL, microtime() );
	wp_enqueue_style( 'hamo-style', get_template_directory_uri() . '/sass/main.css' );

	wp_enqueue_script( 'hamo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '', true );

	wp_enqueue_script( 'hamo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '', true );

	wp_enqueue_script( 'hamo-jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js", array(), '', true );

	wp_enqueue_script( 'hamo-js', get_template_directory_uri() . '/js/main.js', array(), microtime(), true );

	wp_enqueue_script( 'hamo-live', "http://localhost:35729/livereload.js", array(), '', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'font-awesome', "https://use.fontawesome.com/releases/v5.8.1/css/all.css");
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
//require get_template_directory() . '/inc/template-functions.php';

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