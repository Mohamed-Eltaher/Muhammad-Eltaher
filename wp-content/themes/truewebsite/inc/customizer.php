<?php
/**
 * hamo Theme Customizer
 *
 * @package hamo
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hamo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'hamo_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'hamo_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'hamo_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function hamo_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function hamo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/* My Own Customization */


function me_customize_register($wp_customize){

	// About me customization
    
    $wp_customize->add_section('me_text_about', array(
        'title'    => __('Customize About Me', 'me'),
        'description'   => sprintf(__('Options', 'me')),
        'priority' => 130
    ));

    // content

    $wp_customize->add_setting('head_option', array(
        'default'   => _x('head goes here', 'me'),
        'type'     => 'theme_mod'
    ));
    $wp_customize->add_control('me_head', array(
        'label'      => __('head', 'me'),
        'section'    => 'me_text_about',
        'priority'   => 1,
        'settings'   => 'head_option',
        'type'       => 'textarea'
        
    ));
    
    $wp_customize->add_setting('text_option', array(
        'default'   => _x('text goes here', 'me'),
        'type'     => 'theme_mod'
    ));
    $wp_customize->add_control('me_text', array(
        'label'      => __('Paragraph', 'me'),
        'section'    => 'me_text_about',
        'priority'   => 2,
        'settings'   => 'text_option',
        'type'       => 'textarea'
        
    ));

    // image

    $wp_customize->add_setting('me_custome_image');

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'me_own_image', array(
        'label'      => __('Profile Picture', 'me'),
        'section'    => 'me_text_about',
        'priority'   => 3,
        'settings'   => 'me_custome_image',
        'width'       => 750,
        'height'      => 1000
        
    )));
};
add_action('customize_register', 'me_customize_register');