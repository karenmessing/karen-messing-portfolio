<?php
namespace theme;

use theme\helpers\Assets as Assets;

class Theme {
  function __construct() {
    # Define theme constants.
    require_once(dirname(__FILE__) . '/constants.php');
    
    spl_autoload_register(function ($class) {
      # Convert the class name to a path.
      $class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
      
      # Remove the 'theme/' part of the path.
      $class = str_replace(__NAMESPACE__ . '/', '', $class);
      $class = __DIR__ . DIRECTORY_SEPARATOR . $class;
      
      if (is_readable($class)) {
        require_once $class;
      }
    });
    
    # Various actions.
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
  }
  
  # Output the application JavaScript tag.
  #
  # Returns this.
  public function applicationScript() {
    $use_require = '<script data-main="' . Assets::get('js', 'main') . '" src="' . Assets::get('js', 'libs/require') . '"></script>';
    $use_concat = '<script src="' . Assets::get('js', 'main') . '"></script>';
    return ENV === 'development' ? $use_require : $use_concat;
  }
}