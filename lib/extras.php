<?php

namespace Roots\Fire\Extras;

use Roots\Fire\Config;

/**
 * Add some class to body
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Read more', 'fire') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');
