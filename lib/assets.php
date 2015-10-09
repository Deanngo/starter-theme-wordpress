<?php
namespace Roots\Fire\Assets;

function assets() {
  wp_enqueue_style('fire/styles', ACCESS_PATH.'/styles.css', false, null);  
  wp_enqueue_script('fire/js', ACCESS_PATH.'/javascripts/app.min.js', ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);