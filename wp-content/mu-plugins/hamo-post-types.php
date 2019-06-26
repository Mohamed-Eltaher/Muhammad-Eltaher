<?php

function hamo_post_types() {
  //campus
  /* register_post_type('campus', array(
    'supports'  => array('title', 'editor', 'excerpt'),
    'rewrite' => array('slug' => 'campuses'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'campuses',
      'add_new_item' => 'Add New campus',
      'edit_item' => 'Edit campus',
      'all_items' => 'All campuses',
      'singular_name' => 'campus'
    ),
    'menu_icon' => 'dashicons-location-alt'
  ));
*/
  //project
  register_post_type('testimonial', array(
    'supports'  => array('title', 'editor', 'excerpt'),
    'rewrite' => array('slug' => 'testimonials'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'testimonials',
      'add_new_item' => 'Add New testimonial',
      'edit_item' => 'Edit testimonial',
      'all_items' => 'All testimonials',
      'singular_name' => 'testimonial'
    ),
    'menu_icon' => 'dashicons-calendar'
  ));

  //Language
  /*
  register_post_type('language', array(
    'supports'  => array('title', 'editor'),
    'rewrite' => array('slug' => 'languages'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'languages',
      'add_new_item' => 'Add New language',
      'edit_item' => 'Edit language',
      'all_items' => 'All languages',
      'singular_name' => 'language'
    ),
    'menu_icon' => 'dashicons-awards'
  )); */

  //Professors
  /*
  register_post_type('Professor', array(
    'supports'  => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'labels' => array(
      'name' => 'Professors',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor'
    ),
    'menu_icon' => 'dashicons-welcome-learn-more'
  ));
  */
}

add_action('init', 'hamo_post_types');