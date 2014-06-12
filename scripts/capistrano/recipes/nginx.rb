namespace :nginx do
    desc "Refresh the configuration"
    task :reload do
        puts "Password required for deploy user:"
        sudo "~/scripts/update_nginx_config.sh", :pty => true
    end
end