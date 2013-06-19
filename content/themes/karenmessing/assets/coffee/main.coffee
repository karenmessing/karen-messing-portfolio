# Require.js configuration.
require.config
  appDir: './'
  paths: {}
  shim: {}

# Main application module.
define [], ->
  console.log 'it works'