# Require any additional compass plugins here.
require 'susy'

http_path  = '/'
project_name = ''
asset_path = "content/themes/#{project_name}/assets"

css_dir = if environment == :production
  "build/#{asset_path}/css"
else
  "#{asset_path}/css"
end

sass_dir        = "#{asset_path}/sass"
images_dir      = "#{asset_path}/images"
javascripts_dir = "#{asset_path}/js"
fonts_dir       = "#{asset_path}/fonts"

# Enable debug info to use source maps. Works in Chrome Dev Tools.
sass_options = {:debug_info => true}

# You can select your preferred output style here (can be overridden via the command line):
# output_style = :expanded or :nested or :compact or :compressed
output_style = (environment == :production) ? :compressed : :expanded

# To enable relative paths to assets via compass helper functions. Uncomment:
relative_assets = true

module Sass::Script::Functions
  # Public: Get the name of the project, which is the directory this site
  #         is being accessed at.
  #
  # Examples
  #
  #   If this project is being accessed at http://0.0.0.0/app/
  #
  #   @debug project()
  #   # => 'app'
  #
  # Returns the project name.
  def project
    Sass::Script::String.new(project_name)
  end
end