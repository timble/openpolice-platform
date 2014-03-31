require "new_relic/recipes"

server "police-production", :app, :web, :db, :primary => true

set :rails_env, "production"
set :branch, "master"

before "deploy", "github:mirror"
before "deploy:migrations", "github:mirror"

after "deploy:update", "newrelic:notice_deployment"
after "deploy:migrate", "newrelic:notice_deployment"