server "police-production", :app, :web, :db, :primary => true

set :rails_env, "production"
set :branch, "v2/master"
