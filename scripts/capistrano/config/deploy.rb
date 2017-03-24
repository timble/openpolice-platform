require "capistrano/ext/multistage"

## Stage settings.
set :stages, ["staging", "production"]
set :default_stage, "staging"

## Application settings.
set :application, "portal"
set :app_symlinks, ["sites", "config/config.php", "config/key.p12"]

# Server user settings.
set :user, "deploy"
set :port, 22
set :use_sudo, false

# Deployment settings.
set :deploy_to, "/var/www/v2.mijnpolitie.be/capistrano"
set :deploy_via, :remote_cache
set :copy_exclude, [".git"]
set :keep_releases, 3

# Repository settings.
set :repository, "git@github.com:belgianpolice/internet-platform.git"
set :scm, :git
set :scm_username, "deploy@timble.net"

namespace :deploy do
    # Overwrite :finalize_update to prevent unrelevant command executions.
    desc "Finalize update"
    task :finalize_update, :roles => :app, :except => { :no_release => true } do
        run "chmod -R g+w #{release_path}" if fetch(:group_writable, true)
    end

    desc "Create symbolic links for shared directories."
    task :symlink_shared, :roles => :app do
        if app_symlinks
            app_symlinks.each do |link|
                # Explicitly delete target if it's a directory
                if 'true' ==  capture("if [ -d #{release_path}/#{link} ]; then echo 'true'; fi").strip
                    run "rm -rf #{release_path}/#{link}"
                end

                run "ln -fns #{shared_path}/#{link} #{release_path}/#{link}"
            end
        end

        # Symlink the Phpmig configuration file back into the phpmig directory
        run "ln -fns #{shared_path}/scripts/phpmig/config.php #{release_path}/scripts/phpmig/config.php"
    end

    desc "Migrate database."
    task :migrate do
        run "cd #{release_path}/scripts/phpmig && composer --no-progress install && bin/phpmig migrate"
    end

    desc "Run composer"
    task :composer, :roles => :app do
        run "cd #{release_path}/ && composer --no-progress install"
    end

    desc "Restart the application."
    #task :restart do
    #   run "http_proxy='' curl -vs -o /dev/null http://localhost/apc_clear.php > /dev/null 2>&1"
    #end

    # Do nothing in these tasks.
    task :cold do; end
    task :start do; end
    task :stop do; end
end

# Hook into default tasks.
after "deploy:update_code", "deploy:symlink_shared"
after "deploy:update_code", "deploy:composer"
after "deploy:update", "deploy:cleanup"
after "deploy:migrate", "deploy:cleanup"
