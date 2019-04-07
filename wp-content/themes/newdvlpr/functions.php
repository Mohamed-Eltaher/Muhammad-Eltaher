<?php

require_once('class-wp-bootstrap-navwalker.php');

add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('aside', 'gallery', 'link'));



// css implementation
function dvlpr_add_styles() {
	wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'fontawesome-css2', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css' );
	wp_enqueue_style('fontawesome-css', get_template_directory_uri() . '/css/fontawesome.min.css');
	wp_enqueue_style('main-css', get_template_directory_uri() . '/css/main.css');
}

// js implementation
function dvlpr_add_scripts() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, '', true);
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, true);
	wp_enqueue_script( 'fontawesome-js', get_template_directory_uri() . '/js/fontawesome.min.js', array(), false, true);
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array(), false, true);
}

// Navigation bar
function dvlpr_register_custome_menu() {
	register_nav_menus(array(
		'bootstrap-menu' => 'Navigation Bar',
		'footer-menu'    => 'Footer Bar'
	));
}

add_action('wp_enqueue_scripts', 'dvlpr_add_styles');
add_action('wp_enqueue_scripts', 'dvlpr_add_scripts');
add_action('init', 'dvlpr_register_custome_menu');

// Enhance Excerpt
function dvlpr_extend_excerpt_length($length) {
	if(is_author()){
		return 40;
	}elseif(is_category()){
		return 50;
	}else {
	return 15;
	}
}

add_filter('excerpt_length', 'dvlpr_extend_excerpt_length');


// register sidebar

function dvlpr_main_sidebar() {
	register_sidebar(array(
		'name'  	   => 'Main Sidebar',
		'id'  	 	   =>'main-sidebar',
		'description'  =>'main sidebar appear everwhere',
		'class'  	   => 'main-sidebar',
		'before_widget'=>'<div class="widget-content">',
		'after_widget' =>"</div>",
		'before_title' =>'<h3 class="widget-title">',
		'after_title'  =>'</h3>'

	));
}

add_action('widgets_init', 'dvlpr_main_sidebar');


function dvlpr_remove_paragraph($content) {
	remove_filter('the_content', 'wpautop');
	return $content;
}

add_filter('the_content', 'dvlpr_remove_paragraph', 0);



/* My Own Customization */

function momo_customize_register($wp_customize){
    
    $wp_customize->add_section('momo_color_scheme', array(
        'title'    => __('Color Scheme', 'momo'),
        'description'   => sprintf(__('Options for image', 'momo')),
        'priority' => 130
    ));
    //  =============================
    //  = Text Input                =
    //  =============================
    $wp_customize->add_setting('momo_theme_options[text_test]', array(
        'default'   => _x('test first paragraph text default', 'momo'),
		'type'     => 'theme_mod'
    ));
    $wp_customize->add_control('momo_text_test', array(
        'label'      => __('Text Test', 'momo'),
        'section'    => 'momo_color_scheme',
        'settings'   => 'momo_theme_options[text_test]'
    ));
}
    add_action('customize_register', 'momo_customize_register');