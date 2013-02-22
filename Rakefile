require 'rubygems'
require 'bundler/setup'
require 'rake'
require 'psych'


desc 'Build the production version of the site.'
task :build => %w(build:optimized)

namespace :build do
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
    puts 'compile coffeescript for build'
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