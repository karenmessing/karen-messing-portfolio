require 'rubygems'
require 'bundler/setup'
require 'rake'
require 'psych'
require 'coffee-script'

# Get the config file.
config = Psych.load File.read 'config/config.yml'

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
    FileUtils.cp_r %w(wp content wp-config.php index.php favicon.ico mint), config['build_dir']
    puts "The WordPress assets have been moved to #{config['build_dir']}/."
  end
  
  desc 'Compile the CSS using Compass.'
  task :css, [:env] do |task, args|
    args.with_defaults :env => 'development'
    force = args[:env] == 'production' ? '--force' : ''
    cmd = "bundle exec compass compile -e #{args[:env]} #{force}"
    puts "Running: #{cmd}"
    system cmd
  end
  
  desc 'Optimize the JavaScript using the r.js optimizer.'
  task :js, [:env] do |task, args|
    args.with_defaults :env => 'development'
    optimize = args[:env] == 'production' ? 'uglify2' : 'none'
    cmd = "node r.js -o app.build.js optimize=#{optimize}"
    puts "Running: #{cmd}"
    system cmd
  end
  
  desc 'Compile CoffeeScript to JavaScript.'
  task :coffee do
    input = "content/themes/#{config['themename']}/#{config['coffeescript']['in']}"
    output = "content/themes/#{config['themename']}/#{config['coffeescript']['out']}"
    files = Dir.glob("#{input}/**/*").reject {|f| File.directory?(f)}
    
    # Compile each file.
    files.each do |file|
      newDir = File.dirname(file).sub!(input, output)
      newName = File.basename(file).sub!('.coffee', '.js')

      FileUtils.mkdir_p newDir
      newpath = File.join newDir, newName
      compiled = CoffeeScript.compile(File.read file)
      newFile = File.open newpath, 'w+' do |f|
        f.write compiled
      end

      puts "Compiled #{file} to #{newpath}."
    end
  end
  
  desc 'Optimize images.'
  task :img do
    puts 'optimize images for build'
  end
  
  desc 'Build a debug, staging ready version of the site.'
  task :debug => %w(wp coffee css js) do
    puts 'Built debug version!'
  end
  
  desc 'Build an optimized, production ready version of the site.'
  task :optimized => %w(wp coffee img) do
    Rake::Task['build:css'].invoke('production')
    Rake::Task['build:js'].invoke('production')
    puts 'Built optimized version!'
  end
end

desc 'Sync database and content from production to development.'
task :sync => %w(sync:stage)

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
  task :stage => %w(sync:stage:db sync:stage:content)
  
  namespace :stage do
    desc 'Sync the staging database to the local database.'
    task :db do
      print 'This will overwrite your existing database. Continue? [y/n]: '
      resp = STDIN.gets.chomp
      exit unless resp == 'y'
      
      dev = config['development']['database']
      deploy = config['staging']['deploy']
      db = config['staging']['database']
      
      # Dump database.
      cmd = "ssh #{deploy['user']}@#{deploy['host']} \"mysqldump -u#{db['user']} -p#{db['pass']} #{db['name']} > /tmp/#{db['name']}.sql\""
      system cmd
      
      # Download database.
      cmd = "rsync -avzP #{deploy['user']}@#{deploy['host']}:/tmp/#{db['name']}.sql ./#{db['name']}.sql"
      system cmd
      
      # Import database.
      pass = dev['pass'] ? " -p#{dev['pass']}" : ''
      cmd = "mysql -u#{dev['user']}#{pass} #{dev['name']} < #{db['name']}.sql"
      system cmd
      
      # Cleanup.
      FileUtils.rm "#{db['name']}.sql"
    end
    
    desc 'Sync the staging content directory to the local content directory.'
    task :content do
      puts 'Syncing remote content.'
      deploy = config['staging']['deploy']
      
      # Sync content.
      cmd = "rsync -avzP #{deploy['user']}@#{deploy['host']}:#{deploy['directory']}/content/uploads/ ./content/uploads/"
      system cmd
    end
  end
end

desc 'Export the database.'
task :db => %w(db:dump)

namespace :db do
  desc "Export the local database to #{config['db_dir']}/"
  task :dump do
    db = config['development']['database']
    pass = db['password'].nil? ? '' : "-p#{db['password']}"
    time = Time.now.strftime('%Y-%m-%d-%H%M%S')
    
    FileUtils.mkdir_p config['db_dir'] unless File.directory? config['db_dir']
    system "mysqldump -u#{db['user']} #{pass} #{db['name']} > #{config['db_dir']}/#{db['name']}_#{time}.sql"
    puts "Exported #{db['name']} to #{config['db_dir']}/#{db['name']}_#{time}.sql"
  end
end

desc 'Deploy to staging.'
task :deploy => %w(deploy:staging)

namespace :deploy do
  desc 'Deploy to staging.'
  task :staging => %(build:debug) do
    deploy = config['staging']['deploy']
    cmd = "rsync -az --progress --delete --exclude='.htaccess' --exclude='local-config.php' build/ #{deploy['user']}@#{deploy['host']}:#{deploy['directory']}/"
    puts "Running: #{cmd}"
    system cmd
    cmd = "ssh #{deploy['user']}@#{deploy['host']} 'chmod -R 777 #{deploy['directory']}/content/uploads'"
    puts "Setting permissions."
    system cmd
  end
  
  desc 'Deploy to production.'
  task :prod => %(build:optimized) do
    deploy = config['production']['deploy']
    cmd = %Q{\
rsync -az --progress --delete \
--exclude='.htaccess' \
--exclude='local-config.php'  \
--exclude='content/db.php' \
--exclude='content/object-cache.php' \
--exclude='content/advanced-cache.php' \
--exclude='content/w3-total-cache-config-preview.php' \
--exclude='content/plugins/w3tc-wp-loader.php' \
--exclude='content/w3tc/' \
--exclude='content/w3tc-config/' \
--exclude='content/cache/' \
build/ #{deploy['user']}@#{deploy['host']}:#{deploy['directory']}/
}
    puts "Running: #{cmd}"
    system cmd
    cmd = "ssh #{deploy['user']}@#{deploy['host']} 'chmod -R 777 #{deploy['directory']}/content/uploads'"
    puts "Setting permissions."
    system cmd
  end
end