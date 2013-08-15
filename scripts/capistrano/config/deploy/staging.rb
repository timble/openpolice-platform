server "police-staging", :app, :web, :db, :primary => true

set :rails_env, "staging"
set :branch, "master"