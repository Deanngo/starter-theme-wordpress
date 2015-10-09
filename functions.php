<?php
$fire_includes = [
  'lib/utils.php',       
  'lib/init.php',        
  'lib/wrapper.php',     
  'lib/config.php',      
  'lib/assets.php',      
  'lib/titles.php',      
  'lib/extras.php',      
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

