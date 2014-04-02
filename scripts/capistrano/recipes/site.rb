namespace :site do
    desc "Create a new site"
    task :create do
        zone     = ''
        db_user  = 'fedpol'
        db_pass  = ''
        language = 'nl-NL'
        title    = ''

        # Get the necessary info from the user
        begin
            zone = Capistrano::CLI.ui.ask("New zone number [5xxx] : ")

            puts "Invalid zone number!".red if (zone !~ /^5[0-9]{3}$/ or zone.empty?)
        end while zone !~ /^5[0-9]{3}$/

        # Make sure zone doesn't exist
        path = "#{deploy_to}/shared/sites/#{zone}"
        if remote_file_exists?(path)
            abort "Site #{zone} already exists!".red
        end

        if remote_database_exists?(zone, db_user, db_pass)
            abort "Database #{zone} already exists!".red
        end

        begin
            title = Capistrano::CLI.ui.ask("Site name: ")
        end while title.empty?

        begin
            language = Capistrano::CLI.ui.ask("Language [default: nl-NL] : ")
            language = 'nl-NL' if language.empty?
        end while ! ['nl-NL', 'fr-FR'].include? language

        template = Capistrano::CLI.ui.ask("Database template [default: 5388] : ")
        template = '5388' if template.empty?

        unless (remote_database_exists?(template, db_user, db_pass) or template != zone)
            abort "Database #{template} doesn't exist!".red
        end

        db_pass = Capistrano::CLI.password_prompt("Database password [user: #{db_user}]: ")

        # Create the folder structure
        folders = ['config', 'files/attachments', 'files/downloads']
        folders.each do |folder|
          run "mkdir -p #{path}/#{folder}"
        end

        # Setup config.php
        config = ERB.new(File.read("resources/config.php.erb")).result(binding)
        put config, "#{path}/config/config.php"

        # Update the file permissions
        puts "Password required for deploy user:"
        sudo "~/scripts/v2_update_sites_permissions.sh", :pty => true

        # Copy the database
        time =  Time.now.strftime('%Y%m%d%H%M%S')
        dump = "/tmp/#{template}_#{time}.sql"

        execute_mysql?("mysql -u\"#{db_user}\" -p -e \"CREATE DATABASE \\`#{zone}\\` CHARACTER SET utf8 COLLATE utf8_general_ci; FLUSH privileges;\"", db_pass)
        execute_mysql?("mysqldump -u\"#{db_user}\" -p #{template} > #{dump}", db_pass)
        execute_mysql?("mysql -u\"#{db_user}\" -p #{zone} -e \"source #{dump};\"", db_pass)

        run "rm -f #{dump}"

        # Prepare the database
        sql = ERB.new(File.read("resources/site-creation.sql.erb")).result(binding)
        put sql, "/tmp/#{zone}.sql"
        execute_mysql?("mysql -u\"#{db_user}\" -p #{zone} -e \"source /tmp/#{zone}.sql;\"", db_pass)
        run "rm -f /tmp/#{zone}.sql"

        # Output the Nginx directives and success message
        puts "#{zone} has been created!".green
        nginx = <<-NGINX.gsub(/^ {12}/, '')
            ======== START =========

            # #{zone} #{title}
            location  ~ "^/#{zone}(?:/.*)?$"  {
                include /etc/nginx/conf.d/proxy.inc;
                break;
            }

            ======== END ===========
        NGINX

        puts "Add the following directives to the /nginx/conf.d/v2.inc or v2.stage.inc file in the infrastructure repository:"
        puts nginx
    end
end

## Helper methods: ##
# @TODO where should we put these?
# Check if a file exists on all of the remote servers
def remote_file_exists?(path)
  results = []

  invoke_command("if [ -e '#{path}' ]; then echo -n 'true'; else echo -n 'false'; fi") do |ch, stream, out|
    results << (out == 'true')
  end

  results.all?
end

# Check if a database exists on all servers
def remote_database_exists?(zone, db_user, db_pass)
    exists = []

    invoke_command("mysql --batch --skip-column-names -e \"SHOW DATABASES LIKE '#{zone}'\" -u\"#{db_user}\" -p | grep #{zone} || echo 'false';") do |ch, stream, out|
        if out =~ /^Enter password: /
            ch.send_data "#{db_pass}\n"
        else
            exists << (out.strip == zone)
        end
    end

    exists.all?
end

# Execute MySQL commands without passing the password in the process name
def execute_mysql?(cmd, db_pass)
    run(cmd) do |ch, stream, out|
        if out =~ /^Enter password: /
            ch.send_data "#{db_pass}\n"
        end
    end
end