<?php
global $km;

# Get the app, for use in template files.
#
# Returns the app.
function getApp() {
  global $km;
  return $km;
}

# Start up the app.
require_once dirname(__FILE__) . '/theme/Theme.php';
$km = new theme\Theme();

# Register a nav menu.
register_nav_menus(array(
  'global_nav' => 'Global navigation.'
));

# Add a custom images size for portfolio images.
# add_image_size('portfolio', 800, 9999);