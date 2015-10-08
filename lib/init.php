<?php

namespace Roots\Fire\Init;

use Roots\Fire\Assets;

/**
 * Fire setup
 */
function setup() {
    
   // Enable plugins to manage the document title  
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus  
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'fire')
  ]);

  // Add post thumbnails  
  add_theme_support('post-thumbnails');

  // Add post formats  
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Add HTML5 markup for captions  
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery']);
  
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'fire'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'fire'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');
