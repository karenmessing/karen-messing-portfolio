<?php
# W3 Total Cache.
# define('WP_CACHE', getenv('ENVIRONMENT') === 'production' ? true : false);

# Site URLs
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp/');

# Local configuration file.
if (file_exists(dirname(__FILE__) . '/local-config.php')) {
  include(dirname(__FILE__) . '/local-config.php');
}

# Custom content directory.
define('WP_CONTENT_DIR', dirname(__FILE__) . '/content');
define('WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content');

# MySQL settings.
define('DB_NAME', DB_NAME);
define('DB_USER', DB_USER);
define('DB_PASSWORD', DB_PASS);
define('DB_HOST', DB_HOST);

# Other database settings.
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

# Salts: https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY',         '');
define('SECURE_AUTH_KEY',  '');
define('LOGGED_IN_KEY',    '');
define('NONCE_KEY',        '');
define('AUTH_SALT',        '');
define('SECURE_AUTH_SALT', '');
define('LOGGED_IN_SALT',   '');
define('NONCE_SALT',       '');

# Prefix.
$table_prefix  = 'wp_';

# Language.
define('WPLANG', '');

# Debug.
define('WP_DEBUG', ENV === 'production' ? false : true);

# ABSPATH constant.
if (!defined('ABSPATH')) {
  define('ABSPATH', dirname(__FILE__) . '/wp/');
}

# Go.
require_once(ABSPATH . 'wp-settings.php');