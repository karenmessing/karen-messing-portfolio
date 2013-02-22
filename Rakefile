require 'rubygems'
require 'bundler/setup'
require 'psych'



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