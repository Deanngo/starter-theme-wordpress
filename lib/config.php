<?php

namespace Roots\Fire\Config;

use Roots\Fire\ConditionalTagCheck;

/**
 * Configuration values
 */
 define('ENV', 'development');

if (!defined('DIST_DIR')) {
  // Path to the build directory for front-end assets
  define('DIST_DIR', '/dist/');
}

if (!defined('ACCESS_PATH')) {
  if(ENV === 'development'){
       define('ACCESS_PATH', 'assets');
  }else{
      define('ACCESS_PATH', '');
  }
}

/**
 * Display sidebar on some special page 
 */
function display_sidebar() {
  static $display;
  
  isset($display) || $display = !in_array(true, [
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('fire/display_sidebar', $display);
}
