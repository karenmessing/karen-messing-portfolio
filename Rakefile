require 'rubygems'
require 'bundler/setup'
require 'rake'
require 'psych'
require 'coffee-script'

# Get the config file.
config = Psych.load(File.read('config/config.yml'))

task :default

desc 'Remove the build directory.'
task :clean, :dir do |task, args|
  args.with_defaults(:dir => config['build_dir'])
  
  unless File.directory?(args[:dir])
    puts "The #{args[:dir]}/ directory does not exist!"
  else
    FileUtils.rm_rf args[:dir]
    puts "The #{args[:dir]}/ directory was successfully removed."
  end
end

desc 'Build the production version of the site.'
task :build => %w(build:optimized)

namespace :build do
  desc 'Create the build directory.'
  task :create => %w(clean) do
    FileUtils.mkdir config['build_dir']
    puts "The #{config['build_dir']}/ directory created."
  end
  
  desc 'Move WordPress assets into the build.'
  task :wp => %w(create) do
    # Move the WordPress core.
    FileUtils.cp_r %w(wp content wp-config.php index.php), config['build_dir']
    puts "The WordPress assets have been moved to #{config['build_dir']}/."
  end
  
  desc 'Compile the CSS using Compass.'
  task :css, [:env] do |task, args|
    args.with_defaults :env => 'development'
    force = args[:env] == 'production' ? '--force' : ''
    puts "bundle exec compass compile -e #{args[:env]} #{force}"
  end
  
  desc 'Optimize the JavaScript using the r.js optimizer.'
  task :js, [:env] do |task, args|
    args.with_defaults :env => 'development'
    optimize = args[:env] == 'production' ? 'uglify' : 'none'
    puts "node r.js -o app.build.js optimize=#{optimize}"
  end
  
  desc 'Compile CoffeeScript to JavaScript.'
  task :coffee do
    input = config['coffeescript']['in']
    output = config['coffeescript']['out']
    files = Dir.glob("#{input}/**/*").reject {|f| File.directory?(f)}
    
    # Compile each file.
    files.each do |file|
      newDir = File.dirname(file).sub!(input, output)
      newName = File.basename(file).sub!('.coffee', '.js')

      FileUtils.mkdir_p newDir
      newpath = File.join newDir, newName
      compiled = CoffeeScript.compile(File.read file)
      newFile = File.new newpath, 'w+'
      newFile.write compiled
      puts "Compiled #{file} to #{newpath}."
    end
  end
  
  desc 'Optimize images.'
  task :img do
    puts 'optimize images for build'
  end
  
  desc 'Build a debug, staging ready version of the site.'
  task :debug => %w(coffee css js) do
    puts 'Built debug version!'
  end
  
  desc 'Build an optimized, production ready version of the site.'
  task :optimized => %w(coffee img) do
    Rake::Task['build:css'].invoke('production')
    Rake::Task['build:js'].invoke('production')
    puts 'Built optimized version!'
  end
end

desc 'Sync database and content from production to development.'
task :sync => %w(sync:db sync:content)

namespace :sync do
  desc 'Sync the production database to the local database.'
  task :db do
    puts 'sync production db to development'
  end
  
  desc 'Sync the production content directory to the local content directory.'
  task :content do
    puts 'sync production content to development'
  end
  
  desc 'Sync database and content from staging to development.'
  task :stage => %w(sync:db:stage sync:content:stage)
  
  namespace :db do
    desc 'Sync the staging database to the local database.'
    task :stage do
      puts 'sync staging db'
    end
  end
  
  namespace :content do
    desc 'Sync the staging content directory to the local content directory.'
    task :stage do
      puts 'sync staging content'
    end
  end
end