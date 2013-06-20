<?php /*

  Security helper.
  
*/
namespace theme\helpers;

class Security {
  /**
   * Public: Force a user to log in. Only forces a login when the environment
   * is staging. Otherwise, pass `true` to force a login no matter what.
   *
   * $override  - True to force users to login. Defaults to false.
   *
   * Returns nothing.
   */
  public static function forceLogin($override = false) {
    if (!is_user_logged_in() && ENV === 'staging' || $override) {
      wp_redirect(WP_SITEURL . 'wp-login.php');
      exit;
    }
  }
}