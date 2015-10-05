<?php
$fire_includes = [
  'lib/utils.php',                 // Utility functions
  'lib/init.php',                  // Initial theme setup and constants
  'lib/wrapper.php',               // Theme wrapper class
  'lib/config.php',                // Configuration
  'lib/assets.php',                // Scripts and stylesheets
  'lib/titles.php',                // Page titles
  'lib/extras.php',                // Custom functions
];

foreach ($fire_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'fire'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

add_action('wp_enqueue_scripts', 'fire_enqueue_assets');
function fire_enqueue_assets() {
    
    // bower:css
    // endbower
    
    // bower:js
    // endbower
}

