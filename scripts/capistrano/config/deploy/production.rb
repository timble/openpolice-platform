require "new_relic/recipes"

server "police-production", :app, :web, :db, :primary => true

set :rails_env, "production"
set :branch, "master"

before "deploy", "deploy:mirror"
before "deploy:migrations", "deploy:mirror"

after "deploy:update", "newrelic:notice_deployment"
after "deploy:migrate", "newrelic:notice_deployment"