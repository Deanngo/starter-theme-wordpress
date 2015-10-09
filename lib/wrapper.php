<?php

namespace Roots\Fire\Wrapper;

/**
 * Theme wrapper
 * 
 */

function template_path() {
  return FireWrapping::$main_template;
}

function sidebar_path() {
  return new FireWrapping('templates/sidebar.php');
}

class FireWrapping {
  // full path
  public static $main_template;

  // Basename
  public $slug;

  // Templates
  public $templates;

  //
  public static $base;

  public function __construct($template = 'base.php') {
    $this->slug = basename($template, '.php');
    $this->templates = [$template];

    if (self::$base) {
      $str = substr($template, 0, -4);
      array_unshift($this->templates, sprintf($str . '-%s.php', self::$base));
    }
  }

  public function __toString() {
    $this->templates = apply_filters('fire/wrap_' . $this->slug, $this->templates);
    return locate_template($this->templates);
  }

  public static function wrap($main) {
    // Check
    if (!is_string($main)) {
      return $main;
    }

    self::$main_template = $main;
    self::$base = basename(self::$main_template, '.php');

    if (self::$base === 'index') {
      self::$base = false;
    }

    return new FireWrapping();
  }
}
add_filter('template_include', [__NAMESPACE__ . '\\FireWrapping', 'wrap'], 109);
