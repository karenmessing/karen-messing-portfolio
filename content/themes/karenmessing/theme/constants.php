<?php /*

  Theme constants.

*/
# Useful pages.
define('theme\FRONTPAGE', get_option('page_on_front'));
define('theme\BLOGPAGE', get_option('page_for_posts'));

# Config paths.
define('theme\DIR', get_stylesheet_directory_uri());
define('theme\THEME_NAME', basename(TEMPLATEPATH));
define('theme\CONFIG_PATH', TEMPLATEPATH . '/config');
define('theme\INCLUDE_PATH', TEMPLATEPATH . '/theme/includes');
define('theme\HELPERS_PATH', TEMPLATEPATH . '/theme/helpers');