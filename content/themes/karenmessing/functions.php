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

# Filter the next/previous posts link.
add_filter('next_post_link', function ($output, $format, $link, $post) {
  if (is_object($post)) {
    return '<a href="' . get_permalink($post->ID) . '" class="navigation-arrow mask-icon arrow-right"></a>';
  }
  
  return '<a class="navigation-arrow mask-icon arrow-right inactive"></a>';
}, 10, 4);

add_filter('previous_post_link', function ($output, $format, $link, $post) {
  if (is_object($post)) {
    return '<a href="' . get_permalink($post->ID) . '" class="navigation-arrow mask-icon arrow-left"></a>';
  }

  return '<a class="navigation-arrow mask-icon arrow-left inactive"></a>';
}, 10, 4);