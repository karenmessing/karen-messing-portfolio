<?php /*

  Text helper.

*/
namespace theme\helpers;

class Text {
  /**
   * Echo a slugified string.
   *
   * $string - String to slugify.
   *
   * Returns nothing.
   */
  public static function slugify($string) {
    echo self::get_slug($string);
  }
  
  /**
   * Get a slugified string.
   *
   * $string - String to slugify.
   *
   * Returns the slugified string.
   */
  public static function get_slug($string) {
    $string = strtolower($string);
    return preg_replace('/[\W]/', '-', $string);
  }
}