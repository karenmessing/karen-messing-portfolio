require 'psych'

config = Psych.load(File.read('config/config.yml'))

cs_input = "content/themes/#{config['themename']}/#{config['coffeescript']['in']}"
cs_output = "content/themes/#{config['themename']}/#{config['coffeescript']['out']}"

# Guard::CoffeeScript
guard 'coffeescript', :input => cs_input, :output => cs_output, :all_on_start => true, :error_to_js => true

# Guard::Compass
guard 'compass', :compile_on_start => true

# Guard::LiveReload
guard 'livereload' do
  # Generated assets.
  watch(%r{content/themes/#{config['themename']}/assets/(css|js)/.+\.(css|js)})
  
  # Other assets.
  watch(%r{content/themes/#{config['themename']}/assets/(images|fonts)/.+\.(.*)})
  
  # Theme files.
  watch(%r{content/themes/#{config['themename']}/.+\.php})
end