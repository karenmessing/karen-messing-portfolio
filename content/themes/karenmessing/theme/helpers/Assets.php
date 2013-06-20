<?php /*

  Asset helper.

*/
namespace theme\helpers;

class Assets {
  # Get an asset.
  #
  # $type - The type of asset to get.
  # $file - The filename to get.
  #
  # Returns the asset path.
  public static function get($type, $file) {
    return \theme\DIR . "/assets/${type}/${file}.${type}";
  }
  
  # Echo a JavaScript asset.
  #
  # $filename - The name of the file to load.
  #
  # Examples
  #
  #   Assets::js('file');
  #   '/assets/js/file.js'
  #
  # Returns nothing.
  public static function js($filename) {
    echo self::get('js', $filename);
  }
  
  # Echo a CSS asset.
  #
  # $filename - The name of the file to load.
  #
  # Examples
  #
  #   Assets::css('file');
  #   '/assets/css/file.css'
  #
  # Returns nothing.
  public static function css($filename) {
    echo self::get('css', $filename);
  }
}