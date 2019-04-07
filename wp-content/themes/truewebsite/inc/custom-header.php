<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package hamo
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses hamo_header_style()
 */
function hamo_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'hamo_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'max-width'                  => 1349,
		'height'                 => 625,
		'flex-height'            => true,
		'flex-width'            => true,
		'wp-head-callback'       => 'hamo_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'hamo_custom_header_setup' );

if ( ! function_exists( 'hamo_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see hamo_custom_header_setup().
	 */
	function hamo_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
		// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;




/* My Own Customization */


function video_customize_register($wp_customize){

	// About me customization
    
    $wp_customize->add_section('header_video', array(
        'title'    => __('Header Background Video', 'me'),
        'description'   => sprintf(__('Options', 'me')),
        'priority' => 5
    ));

    // content

    $wp_customize->add_setting('video_option', array(
        'default'   => _x('head goes here', 'me'),
        'type'     => 'theme_mod'
    ));
    $wp_customize->add_control( new WP_Customize_Media_Control($wp_customize, 'me_own_video', array(
        'label'      => __('video', 'me'),
        'section'    => 'header_video',
        'priority'   => 5,
        'settings'   => 'video_option',
        'width'       => 750,
        'height'      => 1000
        
    )));
   
};
    add_action('customize_register', 'video_customize_register');

