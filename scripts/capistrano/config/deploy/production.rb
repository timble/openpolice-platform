require "new_relic/recipes"

server "police-production", :app, :web, :db, :primary => true

set :rails_env, "production"
set :branch, "master"

after "deploy:update", "newrelic:notice_deployment"